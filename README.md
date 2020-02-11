# DELPHI

Delphi uses Google Cloud's Speech-to-Text API to convert audio files to text.

## Installation

Use git to clone this repository and composer to install the necessary packages.

```bash
git clone https://github.com/BasileSamel/delphi.git
cd delphi
composer install
```

You'll need to go through part 1 ("Before you begin") of [the official quickstart tutorial](https://cloud.google.com/speech-to-text/docs/quickstart-client-libraries#client-libraries-install-php) to set up a Cloud Console project and initialize the Cloud Software Development Toolkit (SDK).

## Usage

Launching the web server at localhost:8000
```bash
cd delphi
symfony server:start
```

Using the service:
```php
use App\Service\GoogleTextToSpeechService;

class TestController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(
        GoogleTextToSpeechService $google_service
    ){
        $filename = 'test.wav'; //filename with path, from the project root
        return new Response($google_service->convertToText($filename), 200);
    }
}
```

Commands I used to convert a video interview to a wav file:
```shell
ffmpeg -i video.mp4 -vn -acodec pcm_s16le -ar 44100 -ac 1 audio.wav
ffmpeg -i audio.wav -f segment -segment_time 15 -c copy out%03d.wav
```


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
