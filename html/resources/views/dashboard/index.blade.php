@extends('layouts.app')

@section('content')
    <style>
        .main-container {
            display: flex;
            height: 100vh;
        }

        .bg-light-blue-200 {
            width: 15%;
            min-height: 100vh;
            background-color: #a8d5e2;
            background-image: linear-gradient(to right, rgba(168, 213, 226, 0.7) 100%, rgba(168, 213, 226, 0.7) 40%, rgba(168, 213, 226, 0.7) 0%);
        }

        .audio-container {
            width: 85%;
            height: 100vh;
            overflow-y: auto; /* позволяет прокручивать, если список аудиофайлов слишком длинный */
        }
    </style>
    <div class="main-container">
        <div class="bg-light-blue-200" id="audioListContainer">

        </div>
        <div id="filterControls"></div>
        <div class="audio-container">
            <div class="audio-player">
                <audio id="audioContainer" controls></audio>
            </div>
            <script>
                let audioContext;
                document.addEventListener('DOMContentLoaded', function() {
                    // ваш JSON-объект с ссылками на аудиофайлы и параметрами фильтрации
                    const audioFiles = JSON.parse('<?=$audios->toJson()?>');
                    // создаем новый объект AudioContext
                    if (!audioContext) {
                        let audioContext = new AudioContext();
                    }
// перебираем все аудиофайлы и создаем новый div для каждого из них
                    const audioListContainer = document.querySelector('#audioListContainer');
                    for (const audioId in audioFiles) {
                        const audioData = audioFiles[audioId];
                        const audioUrl = audioData.path;

                        // создаем новый div и добавляем его в .main-container
                        const newDiv = document.createElement('div');
                        newDiv.classList.add('audio-file');
                        audioListContainer.appendChild(newDiv);

                        // создаем новую кнопку и добавляем ее внутрь нового div
                        const newButton = document.createElement('button');
                        newButton.textContent = `Play ${audioId}`;
                        newDiv.appendChild(newButton);

                        // добавляем обработчик события click для кнопки
                        newButton.addEventListener('click', async () => {
                            if (!audioContext) {
                                audioContext = new AudioContext();
                            }

                            const audioElement = document.getElementById('audioContainer');
                            audioElement.src = audioUrl;

                            // Ожидаем загрузки метаданных аудиофайла
                            await new Promise((resolve) => {
                                audioElement.onloadedmetadata = () => {
                                    resolve();
                                };
                            });

                            // Создаем MediaElementAudioSourceNode для управления аудиофайлом
                            const source = audioContext.createMediaElementSource(audioElement);

                            let currentNode = source;
                            if (Array.isArray(audioData.filters)) {
                                for (const filterData of audioData.filters) {
                                    const filter = audioContext.createBiquadFilter();
                                    filter.type = filterData.type;
                                    filter.frequency.value = filterData.frequency;
                                    if (filterData.Q) {
                                        filter.Q.value = filterData.Q;
                                    }
                                    currentNode.connect(filter);
                                    currentNode = filter;
                                }
                            }

                            // Подключаем выходной узел к аудио контексту
                            currentNode.connect(audioContext.destination);

                            // Воспроизводим аудиофайл
                            audioElement.play();
                        });


                    }
                });
            </script>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/wavesurfer.js@4.2.0/dist/wavesurfer.min.js"></script>
@endsection
