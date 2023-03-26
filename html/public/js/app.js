//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb.
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record
const filterControlsContainer = document.getElementById("filterControls");
var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);
document.getElementById("filters").addEventListener("input", (event) => {
    const filtersString = event.target.value;

    if (filtersString.trim() === "") {
        return;
    }

    let filters;
    try {
        filters = JSON.parse(filtersString);
    } catch (e) {
        console.error("Invalid JSON for filters", e);
        return;
    }

    const filterControlsContainer = document.getElementById("filterControls");
    filterControlsContainer.innerHTML = "";

    Object.keys(filters).forEach((filterType) => {
        const parameters = filters[filterType].reduce((acc, param) => {
            const key = Object.keys(param)[0];
            acc[key] = param[key];
            return acc;
        }, {});

        filterControlsContainer.appendChild(createFilterControls(filterType, parameters));
    });
});
function startRecording() {
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/

    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia()
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false
    console.log(stopButton.disabled)
	/*
    	We're using the standard promise based getUserMedia()
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();
        console.log(audioContext)
		//update the format
		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;

		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/*
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";

	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {

	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extension)
	var filename = new Date().toISOString();
    console.log(filename);
	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = "Save to disk";

	//add the new audio element to li
	li.appendChild(au);

	//add the filename to the li
	li.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to li
	li.appendChild(link);

	//upload link
	var upload = document.createElement('a');
	upload.href="#";
	upload.innerHTML = "Upload";
	upload.addEventListener("click", function(event){
		  var xhr=new XMLHttpRequest();
		  xhr.onload=function(e) {
		      if(this.readyState === 4) {
		          console.log("Server returned: ",e.target.responseText);
		      }
		  };
          var effectId = document.getElementById("effect_id").value;
          var filters = document.getElementById("filters").value;
		  var fd=new FormData();
		  fd.append("audio_data",blob, filename+".wav");
          fd.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
          fd.append("effect_id", effectId);
          fd.append("filters", filters);
		  xhr.open("POST","/audio/store",true);
		  xhr.send(fd);
	})
	li.appendChild(document.createTextNode (" "))//add a space in between
	li.appendChild(upload)//add the upload link to li

	//add the li element to the ol
	recordingsList.appendChild(li);
}

function createFilterControls(filterType, parameters) {
    let controlsHtml = '';

    switch (filterType) {
        case 'Bitcrusher':
            controlsHtml += `
                <div>
                    <label for="bitDepth">Bit Depth:</label>
                    <input type="number" id="bitDepth" name="bitDepth" min="1" max="24" value="${parameters.bitDepth}">
                </div>
                <div>
                    <label for="sampleRate">Sample Rate:</label>
                    <input type="number" id="sampleRate" name="sampleRate" min="1000" max="48000" value="${parameters.sampleRate}">
                </div>
            `;
            break;

        case 'Chorus':
            controlsHtml += `
                <div>
                    <label for="delay">Delay:</label>
                    <input type="range" id="delay" name="delay" min="0" max="1" step="0.01" value="${parameters.delay}">
                    <span id="delayValue">${parameters.delay}</span>
                </div>
                <div>
                    <label for="depth">Depth:</label>
                    <input type="range" id="depth" name="depth" min="0" max="1" step="0.01" value="${parameters.depth}">
                    <span id="depthValue">${parameters.depth}</span>
                </div>
            `;
            break;

        case 'Compression':
            controlsHtml += `
                <div>
                    <label for="threshold">Threshold (dB):</label>
                    <input type="number" id="threshold" name="threshold" min="-60" max="0" value="${parameters.threshold}">
                </div>
                <div>
                    <label for="ratio">Ratio:</label>
                    <input type="number" id="ratio" name="ratio" min="1" max="20" step="0.1" value="${parameters.ratio}">
                </div>
                <div>
                    <label for="attack">Attack (ms):</label>
                    <input type="number" id="attack" name="attack" min="0" max="1000" step="1" value="${parameters.attack}">
                </div>
                <div>
                    <label for="release">Release (ms):</label>
                    <input type="number" id="release" name="release" min="0" max="1000" step="1" value="${parameters.release}">
                </div>
            `;
            break;

        case 'Echo':
            controlsHtml += `
                <div>
                    <label for="delay">Delay (s):</label>
                    <input type="number" id="delay" name="delay" min="0" max="5" step="0.01" value="${parameters.delay}">
                </div>
                <div>
                    <label for="decay">Decay:</label>
                    <input type="number" id="decay" name="decay" min="0" max="1" step="0.01" value="${parameters.decay}">
                </div>
            `;
            break;
        case 'Equalizer':
            controlsHtml += `
                <div>
                    <label for="frequency">Frequency (Hz):</label>
                    <input type="number" id="frequency" name="frequency" min="20" max="20000" step="1" value="${parameters.frequency}">
                </div>
                <div>
                    <label for="gain">Gain (dB):</label>
                    <input type="number" id="gain" name="gain" min="-24" max="24" step="0.1" value="${parameters.gain}">
                </div>
                <div>
                    <label for="width">Width (Q):</label>
                    <input type="number" id="width" name="width" min="0.1" max="10" step="0.1" value="${parameters.width}">
                </div>
            `;
            break;

        case 'Flanger':
            controlsHtml += `
                <div>
                    <label for="delay">Delay (ms):</label>
                    <input type="number" id="delay" name="delay" min="0" max="30" step="0.1" value="${parameters.delay}">
                </div>
                <div>
                    <label for="depth">Depth (ms):</label>
                    <input type="number" id="depth" name="depth" min="0" max="10" step="0.1" value="${parameters.depth}">
                </div>
                <div>
                    <label for="regen">Regeneration (dB):</label>
                    <input type="number" id="regen" name="regen" min="-95" max="95" step="0.1" value="${parameters.regen}">
                </div>
                <div>
                    <label for="speed">Speed (Hz):</label>
                    <input type="number" id="speed" name="speed" min="0.1" max="10" step="0.1" value="${parameters.speed}">
                </div>
            `;
            break;

        case 'Gain':
            controlsHtml += `
                <div>
                    <label for="gain">Gain (dB):</label>
                    <input type="number" id="gain" name="gain" min="-24" max="24" step="0.1" value="${parameters.gain}">
                </div>
            `;
            break;
        case 'Limiter':
            controlsHtml += `
                <div>
                    <label for="limit">Limit (dB):</label>
                    <input type="number" id="limit" name="limit" min="-24" max="0" step="0.1" value="${parameters.limit}">
                </div>
            `;
            break;

        case 'Norm':
            controlsHtml += `
                <div>
                    <label for="norm_level">Normalization Level (dB):</label>
                    <input type="number" id="norm_level" name="norm_level" min="-24" max="0" step="0.1" value="${parameters.norm_level}">
                </div>
            `;
            break;

        case 'Overdrive':
            controlsHtml += `
                <div>
                    <label for="gain">Gain (dB):</label>
                    <input type="number" id="gain" name="gain" min="-24" max="24" step="0.1" value="${parameters.gain}">
                </div>
                <div>
                    <label for="color">Color:</label>
                    <input type="number" id="color" name="color" min="0" max="100" step="1" value="${parameters.color}">
                </div>
            `;
            break;
        case 'Phaser':
            controlsHtml += `
        <div>
            <label for="gain_in">Gain In:</label>
            <input type="number" id="gain_in" name="gain_in" min="0" max="1" step="0.01" value="${parameters.gain_in}">
        </div>
        <div>
            <label for="gain_out">Gain Out:</label>
            <input type="number" id="gain_out" name="gain_out" min="0" max="1" step="0.01" value="${parameters.gain_out}">
        </div>
        <div>
            <label for="delay">Delay:</label>
            <input type="number" id="delay" name="delay" min="0" max="5" step="0.01" value="${parameters.delay}">
        </div>
        <div>
            <label for="decay">Decay:</label>
            <input type="number" id="decay" name="decay" min="0" max="0.99" step="0.01" value="${parameters.decay}">
        </div>
        <div>
            <label for="speed">Speed:</label>
            <input type="number" id="speed" name="speed" min="0.1" max="4" step="0.1" value="${parameters.speed}">
        </div>
    `;
            break;
        case 'Pitch':
            controlsHtml += `
        <div>
            <label for="pitch_change">Pitch Change:</label>
            <input type="number" id="pitch_change" name="pitch_change" step="0.01" value="${parameters.pitch_change}">
        </div>
    `;
            break;
        case 'Reverb':
            controlsHtml += `
        <div>
            <label for="reverberance">Reverberance:</label>
            <input type="number" id="reverberance" name="reverberance" min="0" max="100" step="1" value="${parameters.reverberance}">
        </div>
        <div>
            <label for="hf_damping">HF Damping:</label>
            <input type="number" id="hf_damping" name="hf_damping" min="0" max="100" step="1" value="${parameters.hf_damping}">
        </div>
        <div>
            <label for="room_scale">Room Scale:</label>
            <input type="number" id="room_scale" name="room_scale" min="0" max="100" step="1" value="${parameters.room_scale}">
        </div>
        <div>
            <label for="stereo_depth">Stereo Depth:</label>
            <input type="number" id="stereo_depth" name="stereo_depth" min="0" max="100" step="1" value="${parameters.stereo_depth}">
        </div>
        <div>
            <label for="pre_delay">Pre Delay:</label>
            <input type="number" id="pre_delay" name="pre_delay" min="0" max="200" step="1" value="${parameters.pre_delay}">
        </div>
        <div>
            <label for="wet_gain">Wet Gain:</label>
            <input type="number" id="wet_gain" name="wet_gain" min="-20" max="10" step="0.01" value="${parameters.wet_gain}">
        </div>
        <div>
            <label for="wet_gain">Wet Gain:</label>
            <input type="number" id="wet_gain" name="wet_gain" min="-20" max="10" step="0.1" value="${parameters.wet_gain}">
        </div>
        <div>
            <label for="dry_gain">Dry Gain:</label>
            <input type="number" id="dry_gain" name="dry_gain" min="-20" max="10" step="0.1" value="${parameters.dry_gain}">
        </div>
    `;
            break;
        case 'Speed':
            controlsHtml += `
        <div>
            <label for="factor">Factor:</label>
            <input type="number" id="factor" name="factor" min="0.1" max="10" step="0.1" value="${parameters.factor}">
        </div>
    `;
            break;
        case 'Stat':
            controlsHtml += '';
            break;
        case 'Synth':
            filterControls.innerHTML = `
        <div>
            <label for="duration">Duration (seconds):</label>
            <input type="number" id="duration" name="duration" min="0" step="0.01" value="${parameters.duration}">
        </div>
        <div>
            <label for="oscillator">Oscillator:</label>
            <select id="oscillator" name="oscillator">
                <option value="sine" ${parameters.oscillator === 'sine' ? 'selected' : ''}>Sine</option>
                <option value="square" ${parameters.oscillator === 'square' ? 'selected' : ''}>Square</option>
                <option value="triangle" ${parameters.oscillator === 'triangle' ? 'selected' : ''}>Triangle</option>
                <option value="sawtooth" ${parameters.oscillator === 'sawtooth' ? 'selected' : ''}>Sawtooth</option>
            </select>
        </div>
        <div>
            <label for="frequency">Frequency (Hz):</label>
            <input type="number" id="frequency" name="frequency" min="20" max="20000" step="1" value="${parameters.frequency}">
        </div>
    `;
            break;
        case 'Tempo':
            filterControls.innerHTML = `
        <div>
            <label for="factor">Factor:</label>
            <input type="number" id="factor" name="factor" min="0.1" max="10" step="0.1" value="${parameters.factor}">
        </div>
    `;
            break;
        case 'Time scale':
            filterControls.innerHTML = `
        <div>
            <label for="factor">Factor:</label>
            <input type="number" id="factor" name="factor" min="0.1" max="10" step="0.1" value="${parameters.factor}">
        </div>
    `;
            break;
        case 'Tremolo':
            filterControls.innerHTML = `
        <div>
            <label for="speed">Speed (Hz):</label>
            <input type="number" id="speed" name="speed" min="0.1" max="20" step="0.1" value="${parameters.speed}">
        </div>
        <div>
            <label for="depth">Depth (0-1):</label>
            <input type="number" id="depth" name="depth" min="0" max="1" step="0.01" value="${parameters.depth}">
        </div>
    `;
            break;
        case 'Trim':
            filterControls.innerHTML = `
        <div>
            <label for="start">Start (seconds):</label>
            <input type="number" id="start" name="start" min="0" step="0.01" value="${parameters.start}">
        </div>
        <div>
            <label for="end">End (seconds):</label>
            <input type="number" id="end" name="end" min="0" step="0.01" value="${parameters.end}">
        </div>
    `;
            break;
        case 'VAD':
            filterControls.innerHTML = `
        <div>
            <label for="threshold">Threshold (dB):</label>
            <input type="number" id="threshold" name="threshold" min="-100" max="0" step="1" value="${parameters.threshold}">
        </div>
    `;
            break;
        case 'Vol':
            filterControls.innerHTML = `
        <div>
            <label for="gain">Gain (dB):</label>
            <input type="number" id="gain" name="gain" min="-100" max="100" step="0.1" value="${parameters.gain}">
        </div>
    `;
            break;


    }

    return controlsHtml;
}
