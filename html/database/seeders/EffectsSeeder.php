<?php

namespace Database\Seeders;

use App\Models\Effect;
use Illuminate\Database\Seeder;

class EffectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $effectList = [
            [
                'effect_name' => 'bitcrusher',
                'effect_title' => 'Bitcrusher',
                'effect_description' => 'Reduces the bit depth of audio signals.',
                'effect_parameters' => [
                    ['parameter_key' => '-b', 'parameter_value' => '%parameter_1%', 'parameter_name' => 'bits', 'parameter_description' => 'Number of bits to retain'],
                    ['parameter_key' => '-c', 'parameter_value' => '%parameter_2%', 'parameter_name' => 'channels', 'parameter_description' => 'The number of channels to use'],
                    ['parameter_key' => '-s', 'parameter_value' => '%parameter_3%', 'parameter_name' => 'samples', 'parameter_description' => 'Number of samples to average over'],
                    ['parameter_key' => '-u', 'parameter_value' => '%parameter_4%', 'parameter_name' => 'uniformity', 'parameter_description' => 'The proportion of bits in each sample to retain'],
                ],
            ],
            [
                'effect_name' => 'chorus',
                'effect_title' => 'Chorus',
                'effect_description' => 'Add a chorus effect to the audio',
                'effect_parameters' => [
                    ['parameter_key' => '-n', 'parameter_value' => '', 'parameter_name' => 'number', 'parameter_description' => 'Sets the number of delayed signals used by the chorus effect'],
                    ['parameter_key' => '-d', 'parameter_value' => '', 'parameter_name' => 'delay', 'parameter_description' => 'Sets the delay time of the chorus effect'],
                    ['parameter_key' => '-t', 'parameter_value' => '', 'parameter_name' => 'depth', 'parameter_description' => 'Sets the depth (extent) of the chorus effect'],
                    ['parameter_key' => '-s', 'parameter_value' => '', 'parameter_name' => 'spread', 'parameter_description' => 'Sets the spread of the chorus effect']
                ]
            ],
            [
                'effect_name' => 'compression',
                'effect_title' => 'Compression',
                'effect_description' => 'Applies dynamic range compression to audio',
                'effect_parameters' => [
                    ['parameter_key' => '-t', 'parameter_value' => '%parameter_1%',                'parameter_name' => 'type',                'parameter_description' => 'Specify the type of compressor to use (0=downward, 1=upward, 2=clipping, 3=expander, 4=soft-knee)'            ],
                    ['parameter_key' => '-k', 'parameter_value' => '%parameter_2%',                'parameter_name' => 'knee',                'parameter_description' => 'Specify the compressor\'s knee width (in dB)'            ],
                    ['parameter_key' => '-r', 'parameter_value' => '%parameter_3%',                'parameter_name' => 'ratio',                'parameter_description' => 'Specify the compression ratio (a number greater than 1.0)'            ],
                    ['parameter_key' => '-a', 'parameter_value' => '%parameter_4%',                'parameter_name' => 'attack',                'parameter_description' => 'Specify the time in seconds for the gain to decrease by 10dB'            ],
                    ['parameter_key' => '-d', 'parameter_value' => '%parameter_5%',                'parameter_name' => 'decay',                'parameter_description' => 'Specify the time in seconds for the gain to increase by 10dB'            ],
                    ['parameter_key' => '-m', 'parameter_value' => '%parameter_6%',                'parameter_name' => 'makeup-gain',                'parameter_description' => 'Specify the amount of gain to be applied after the compression (in dB)'            ],
                    ['parameter_key' => '-T', 'parameter_value' => '%parameter_7%',                'parameter_name' => 'threshold',                'parameter_description' => 'Specify the threshold level (in dB)'            ],
                    ['parameter_key' => '-s', 'parameter_value' => '%parameter_8%',                'parameter_name' => 'soft-knee',                'parameter_description' => 'Use a soft-knee compressor (equivalent to -k 6dB, -s)'            ],
                ],
            ],
            [
                'effect_name' => 'echo',
                'effect_title' => 'Echo',
                'effect_description' => 'Adds an echo with a specified delay and decay',
                'effect_parameters' => [
                    ['parameter_key' => '-n', 'parameter_value' => '%parameter_1%', 'parameter_name' => 'iterations', 'parameter_description' => 'Set the number of iterations of echo to N (default 5).'],
                    ['parameter_key' => '-D', 'parameter_value' => '%parameter_2%', 'parameter_name' => 'delay', 'parameter_description' => 'Set the delay between each echo to N (default 0.3 seconds).'],
                    ['parameter_key' => '-R', 'parameter_value' => '%parameter_3%', 'parameter_name' => 'decay', 'parameter_description' => 'Set the decay of the echo to N (default 0.4).'],
                ],
            ],
            [
                'effect_name' => 'equalizer',
                'effect_title' => 'Equalizer',
                'effect_description' => 'A flexible equalizer with configurable number of filter taps.',
                'effect_parameters' => [
                    ['parameter_key' => '-n', 'parameter_value' => '%parameter_1%', 'parameter_name' => 'number_of_filter_taps', 'parameter_description' => 'The number of filter taps per filter. The default is 4.'            ],
                    ['parameter_key' => '-', 'parameter_value' => '%parameter_2%', 'parameter_name' => 'filter_specifications', 'parameter_description' => 'The filter specifications. Each specification is a filter type followed by parameters for that type.'            ]
                ],
            ],
            [
                'effect_name' => 'flanger',
                'effect_title' => 'Flanger',
                'effect_description' => 'Adds a flanging effect to the audio.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-d',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'delay',
                        'parameter_description' => 'Specifies the delay in seconds for the swept comb filter. Default value is 0.002 seconds.'
                    ],
                    [
                        'parameter_key' => '-d',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'depth',
                        'parameter_description' => 'Specifies the amount of sweeping deviation in the swept comb filter. Default value is 2.'
                    ],
                    [
                        'parameter_key' => '-w',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'width',
                        'parameter_description' => 'Specifies the width of the swept comb filter. Default value is 71.'
                    ],
                    [
                        'parameter_key' => '-f',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'feedback',
                        'parameter_description' => 'Specifies the amount of feedback to the input signal. Default value is 0.'
                    ],
                ],
            ],
            [
                'effect_name' => 'gain',
                'effect_title' => 'Gain',
                'effect_description' => 'This effect adjusts the audio gain (amplitude) by the given amount in decibels (dB).',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-l',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'level adjustment',
                        'parameter_description' => 'Amount to adjust the audio gain, specified in decibels (dB).'
                    ]
                ]
            ],
            [
                'effect_name' => 'limiter',
                'effect_title' => 'Limiter',
                'effect_description' => 'A limiter effect that restricts the audio signal to a specific threshold level.',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'attack',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'attack',
                        'parameter_description' => 'Attack time in milliseconds, must be between 0.1 and 1000.',
                    ],
                    [
                        'parameter_key' => 'release',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'release',
                        'parameter_description' => 'Release time in milliseconds, must be between 0.1 and 5000.',
                    ],
                    [
                        'parameter_key' => 'threshold',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'threshold',
                        'parameter_description' => 'Threshold in decibels, must be between -20 and 0.',
                    ],
                    [
                        'parameter_key' => 'gain',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'gain',
                        'parameter_description' => 'Gain in decibels, must be between -20 and 20.',
                    ],
                ],
            ],
            [
                'effect_name' => 'norm',
                'effect_title' => 'Norm',
                'effect_description' => 'Amplitude normalization effect.',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'level',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'level',
                        'parameter_description' => 'Level in decibels, must be between -20 and 20.'
                    ],
                ],
            ],
            [
                'effect_name' => 'overdrive',
                'effect_title' => 'Overdrive',
                'effect_description' => 'Adds overdrive distortion to the audio',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'gain_db',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'gain',
                        'parameter_description' => 'Amount of gain to apply in decibels, must be between 0 and 100.'
                    ],
                    [
                        'parameter_key' => 'colour',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'colour',
                        'parameter_description' => 'Amount of color to add to the overdrive sound, must be between 0 and 100.'
                    ],
                    [
                        'parameter_key' => 'drive',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'drive',
                        'parameter_description' => 'Amount of overdrive to apply, must be between 0 and 100.'
                    ],
                    [
                        'parameter_key' => 'dry',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'dry-wet',
                        'parameter_description' => 'Mix between the original and overdriven signals, must be between 0 and 100.'
                    ]
                ]
            ],
            [
                'effect_name' => 'phaser',
                'effect_title' => 'Phaser',
                'effect_description' => 'Adds a phasing effect to the audio',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'gain',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'gain',
                        'parameter_description' => 'Output gain for phaser effect, in decibels. Must be between -20 and 20.'
                    ],
                    [
                        'parameter_key' => 'stages',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'stages',
                        'parameter_description' => 'Number of allpass stages in the phasing effect. Must be between 2 and 24.'
                    ],
                    [
                        'parameter_key' => 'delay',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'delay',
                        'parameter_description' => 'Phase delay in milliseconds. Must be between 0.1 and 20,000.'
                    ],
                    [
                        'parameter_key' => 'decay',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'decay',
                        'parameter_description' => 'Decay in milliseconds. Must be between 2 and 5,000.'
                    ]
                ]
            ],
            [
                'effect_name' => 'pitch',
                'effect_title' => 'Pitch',
                'effect_description' => 'Adjust the pitch of the audio.',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'frequency',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'frequency',
                        'parameter_description' => 'Frequency in Hz to shift the pitch by.'
                    ],
                    [
                        'parameter_key' => 'mode',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'mode',
                        'parameter_description' => 'Shift the pitch by the number of semitones (b) or by frequency (n).'
                    ]
                ],
            ],
            [
                'effect_name' => 'reverb',
                'effect_title' => 'Reverb',
                'effect_description' => 'Reverb effect simulates reverberation of sound.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-n',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'reverberance',
                        'parameter_description' => 'The reverberance of the sound. Must be between 0 and 100.'
                    ],
                    [
                        'parameter_key' => '-w',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'reverberation_time',
                        'parameter_description' => 'The reverberation time in seconds. Must be between 0.1 and 100.'
                    ],
                    [
                        'parameter_key' => '-p',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'wet_gain',
                        'parameter_description' => 'The wet gain, in decibels. Must be between -96 and 0.'
                    ],
                    [
                        'parameter_key' => '-a',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'decay_rate',
                        'parameter_description' => 'The decay rate of the sound. Must be between 0.1 and 2.0.'
                    ],
                    [
                        'parameter_key' => '-h',
                        'parameter_value' => '%parameter_5%',
                        'parameter_name' => 'high_freq_damping',
                        'parameter_description' => 'The high-frequency damping factor. Must be between 0 and 1.0.'
                    ],
                    [
                        'parameter_key' => '-x',
                        'parameter_value' => '%parameter_6%',
                        'parameter_name' => 'cross_stereo',
                        'parameter_description' => 'The cross stereo value. Must be between 0 and 100.'
                    ],
                    [
                        'parameter_key' => '-c',
                        'parameter_value' => '%parameter_7%',
                        'parameter_name' => 'channel',
                        'parameter_description' => 'The audio channel. Must be 1 (mono) or 2 (stereo).'
                    ],
                ],
            ],
            [
                'effect_name' => 'silence',
                'effect_title' => 'Silence',
                'effect_description' => 'Insert a period of silence of the given duration',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-l',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'duration',
                        'parameter_description' => 'Duration of silence in seconds. May be expressed in hh:mm:ss[.nn] format.'
                    ],
                    [
                        'parameter_key' => '-d',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'duration',
                        'parameter_description' => 'Duration of silence in decimal seconds.'
                    ],
                    [
                        'parameter_key' => '-p',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'duration',
                        'parameter_description' => 'Duration of pause between silences in decimal seconds.'
                    ],
                ],
            ],
            [
                'effect_name' => 'speed',
                'effect_title' => 'Speed',
                'effect_description' => 'Change the audio speed without changing the pitch',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'tempo',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'tempo',
                        'parameter_description' => 'Adjust tempo by the given percentage, where 100 is unchanged.',
                    ],
                ],
            ],
            [
                'effect_name' => 'stat',
                'effect_title' => 'Stat',
                'effect_description' => 'Perform statistics on the audio signal.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-v',
                        'parameter_value' => '',
                        'parameter_name' => 'verbose',
                        'parameter_description' => 'Print progress messages.',
                    ],
                    [
                        'parameter_key' => '-b',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'block-size',
                        'parameter_description' => 'Set the size of the processing blocks used for sample-level statistics, in bytes. A large value may cause reduced performance on small files. Default value is 4096 bytes.',
                    ],
                ],
            ],
            [
                'effect_name' => 'synth',
                'effect_title' => 'Synth',
                'effect_description' => 'Generate synthetic sound',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-n',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'notes',
                        'parameter_description' => 'Number of notes to generate (default is 1)',
                    ],
                    [
                        'parameter_key' => '-d',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'duration',
                        'parameter_description' => 'Duration of each note in seconds (default is 1)',
                    ],
                    [
                        'parameter_key' => '-a',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'amplitude',
                        'parameter_description' => 'Amplitude of each note (default is 0.2)',
                    ],
                    [
                        'parameter_key' => '-f',
                        'parameter_value' => '%parameter_4%',
                        'parameter_name' => 'frequency',
                        'parameter_description' => 'Base frequency of the note (default is 440)',
                    ],
                    [
                        'parameter_key' => '-t',
                        'parameter_value' => '%parameter_5%',
                        'parameter_name' => 'waveform',
                        'parameter_description' => 'Waveform to use (default is sine)',
                    ],
                ],
            ],
            [
                'effect_name' => 'tempo',
                'effect_title' => 'Tempo',
                'effect_description' => 'Speed up or slow down audio without changing its pitch',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'speed',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'Speed',
                        'parameter_description' => 'Adjust tempo relative to original, e.g. 1.1 for +10% or 0.9 for -10%.'
                    ],
                    [
                        'parameter_key' => '-s',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'Sustain',
                        'parameter_description' => 'Sustain value, in seconds, e.g. 1.2.',
                    ],
                    [
                        'parameter_key' => '-q',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'Quick',
                        'parameter_description' => 'If set, skip searching for best overlap block.',
                    ],
                ],
            ],
            [
                'effect_name' => 'timescale',
                'effect_title' => 'Time scale',
                'effect_description' => 'Change the tempo of an audio file while maintaining the pitch.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-S',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'speedup',
                        'parameter_description' => 'Speed up the audio by a factor of N (default is 1).'
                    ],
                    [
                        'parameter_key' => '-D',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'duration',
                        'parameter_description' => 'Force the output duration to be exactly D seconds (default is to match the duration of the input).'
                    ],
                    [
                        'parameter_key' => '-pitch',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'pitch',
                        'parameter_description' => 'Shift the pitch of the audio by N cents (default is 0).'
                    ]
                ]
            ],
            [
                'effect_name' => 'tremolo',
                'effect_title' => 'Tremolo',
                'effect_description' => 'Modulate the amplitude of an audio signal.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-t',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'delay',
                        'parameter_description' => 'Time to delay the modulated signal.',
                    ],
                    [
                        'parameter_key' => '-d',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'depth',
                        'parameter_description' => 'The depth of modulation.',
                    ],
                    [
                        'parameter_key' => '-r',
                        'parameter_value' => '%parameter_3%',
                        'parameter_name' => 'rate',
                        'parameter_description' => 'The rate of modulation in Hertz.',
                    ],
                ],
            ],
            [
                'effect_name' => 'trim',
                'effect_title' => 'Trim',
                'effect_description' => 'Trim (remove) silence, audio before or after the given position.',
                'effect_parameters' => [
                    [
                        'parameter_key' => 'start',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'Start Position',
                        'parameter_description' => 'Trim audio before this position.',
                    ],
                    [
                        'parameter_key' => 'end',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'End Position',
                        'parameter_description' => 'Trim audio after this position.',
                    ],
                ],
            ],
            [
                'effect_name' => 'vad',
                'effect_title' => 'VAD (Voice Activity Detection)',
                'effect_description' => 'Detects voice activity and marks time segments with voice activity.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-w',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'window',
                        'parameter_description' => 'The window size in seconds (from 0.0001 to 1).'
                    ],
                    [
                        'parameter_key' => '-t',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'threshold',
                        'parameter_description' => 'The threshold level in decibels (from -100 to 0).'
                    ]
                ],
            ],
            [
                'effect_name' => 'vol',
                'effect_title' => 'Vol',
                'effect_description' => 'Adjust the volume of the audio file.',
                'effect_parameters' => [
                    [
                        'parameter_key' => '-',
                        'parameter_value' => '%parameter_1%',
                        'parameter_name' => 'gain',
                        'parameter_description' => 'Adjust gain by the specified amount in decibels.',
                    ],
                    [
                        'parameter_key' => '-s',
                        'parameter_value' => '%parameter_2%',
                        'parameter_name' => 'scale',
                        'parameter_description' => 'Adjust gain by the specified amount as a multiplier.',
                    ],
                ],
            ],

            // Add more effects here as needed
        ];

        foreach ($effectList as $effect) {
            Effect::create([
                'effect_name' => $effect['effect_name'],
                'effect_title' => $effect['effect_title'],
                'effect_description' => $effect['effect_description'],
                'effect_parameters' => $effect['effect_parameters']
            ]);
        }
    }
}
