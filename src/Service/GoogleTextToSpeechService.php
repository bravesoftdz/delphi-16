<?php
namespace App\Service;
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

class GoogleTextToSpeechService{

    // source: https://cloud.google.com/speech-to-text/docs/quickstart-client-libraries#client-libraries-install-php

    public function convertToText($audio_filename){

        # The name of the audio file to transcribe
        $path = __DIR__ . '/../../' . $audio_filename;

        # get contents of a file into a string
        $content = file_get_contents($path);
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/smithrandir/delphi/delphi-a0e91bfa3a99.json');

        # set string as audio content
        $audio = (new RecognitionAudio())
            ->setContent($content);

        # The audio file's encoding, sample rate and language
        $config = new RecognitionConfig([
            'encoding' => AudioEncoding::LINEAR16,
            'sample_rate_hertz' => 44100,
            'language_code' => 'en-US'
        ]);

        # Instantiates a client
        $client = new SpeechClient();

        # Detects speech in the audio file
        $response = $client->recognize($config, $audio);

        // $result = '';
        foreach ($response->getResults() as $result) {
            $alternatives = $result->getAlternatives();
            $mostLikely = $alternatives[0];
            $transcript = $mostLikely->getTranscript();
            printf('Transcript: %s' . PHP_EOL, $transcript);
        }

        $client->close();
        return 'OK';
    }

}
