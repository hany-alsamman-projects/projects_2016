<?php namespace ScubaClick\Feeder;

use View;
use Request;
use Response;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use ScubaClick\Feeder\Contracts\FeedInterface;
use ScubaClick\Feeder\Exceptions\FeederException;

class Feeder
{
    /**
     * The feed format, either rss, xml or json
     *
     * @var string
     */
    protected $format = 'rss';

    /**
     * Holds all valid date formats
     *
     * @var array
     */
    protected $dateFormats = array(
        'rss'  => 'D, d M Y H:i:s O',
        'atom' => 'Y-m-d\TH:i:sP',
        'json' => 'Y-m-d H:i:s',
    );

    /**
     * Holds all valid date methods
     *
     * @var array
     */
    protected $dateMethods = array(
        'rss'  => 'toRSSString',
        'atom' => 'toATOMString',
        'json' => 'toDateTimeString',
    );

    /**
     * Holds all valid content types
     *
     * @var array
     */
    protected $contentTypes = array(
        'rss'  => 'application/xml',
        'atom' => 'application/xml',
        'json' => 'application/json',
    );

    /**
     * Holds the charset for the feed
     *
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * Holds all feed items
     *
     * @var array
     */
    protected $items = array();

    /**
     * Holds the channel information
     *
     * @var array
     */
    protected $channel = array();

    /**
     * Set the channel
     *
     * Only needs to be set when format is either `rss` or `atom`
     *
     * @param array $channel
     * @return Feeder
     */
    public function setChannel(array $channel)
    {
		$this->channel = $channel;

        return $this;
    }

    /**
     * Set the format
     *
     * Should be set before setItems() if not rss. Does some basic guessing
     * to allow for easy URLs like .../rss.xml, .../atom.xml or .../feed.json
     *
     * @param string $format Either `rss`, `atom` or `json`
     * @return Feeder
     */
    public function setFormat($format)
    {
        $types = array('rss', 'atom', 'json');

        // we don't have a direct hit, so we guess
        if(!in_array($format, $types)) {
            foreach($types as $type) {
                if(Str::contains($format, $type)) {
                    $format = $type;
                    break;
                }
            }
        }

        $this->format = $format;

        return $this;
    }

    /**
     * Set the charset
     *
	 * @param string $charset
     * @return Feeder
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Set the items
     *
     * @param Illuminate\Support\Collection $models
     * @return void
     */
    public function setItems(Collection $models)
    {
        $this->items = new Collection();

        $count = 0;
        foreach($models as $model) {
            if(!$model instanceof FeedInterface) {
                continue;
            }

            $data = $model->getFeedItem($this->format);
            $data['pubDate'] = Carbon::parse($data['pubDate'])->{$this->dateMethods[$this->format]}();

            $rules = array(
                'title'       => 'required',
                'author'      => 'required',
                'link'        => 'required|url',
                'pubDate'     => 'required|date',
                'description' => 'required',
            );

            $validator = Validator::make($data, $rules);

            if($validator->passes()) {
                $this->items->put($count, $data);
                $count++;
            }
        }

        $this->items->sortBy(function($item)
        {
            return $item['pubDate'];
        });

        return $this;
    }

    /**
     * Set the content type
     *
     * @return void
     */
    protected function setContentType()
    {
        $this->contentType = $this->contentTypes[$this->format] .'; charset='. $this->charset;
    }

    /**
     * Set the channel data
     *
     * @return void
     */
    protected function setChannelData()
    {
        // set the pubDate
        if(!isset($this->channel['pubDate'])) {
            $first = $this->items->first();

            if($first) {
                $this->channel['pubDate'] = $first['pubDate'];
            } else {
                $this->channel['pubDate'] = Carbon::parse('now')->{$this->dateMethods[$this->format]}();
            }
        }

        // set the language
        if(!isset($this->channel['language'])) {
            $this->channel['language'] = 'en-us';
        }

        // set the link
        if(!isset($this->channel['link'])) {
            $this->channel['link'] = rtrim(preg_replace('/(json|rss|atom)$/', '', rtrim(Request::url(), '/')), '/');
        }
    }

    /**
     * Fetch the feed
     *
     * @return Response
     */
    public function fetch()
    {
        $this->setChannelData();
        $this->validateInput();
        $this->setContentType();

        if ($this->format == 'json') {
            return Response::json(array(
                'channel' => $this->channel,
                'items'   => $this->items->values()->toArray()
            ), 200, array(
                'Content-type' => $this->contentType
            ));

        } elseif (in_array($this->format, array('rss', 'atom'))) {
            return Response::view('feeder::'. $this->format, array(
                'items'   => $this->items,
                'channel' => $this->channel
            ), 200, array(
                'Content-type' => $this->contentType
            ));
        }
    }

    /**
     * Validate the format
     *
     * @param string $format
     * @return void
     */
    protected function validateInput()
    {
        $rules = array(
            'format'      => 'required|in:rss,atom,json',
            'title'       => 'required',
            'icon'        => 'url',
            'logo'        => 'url',
            'link'        => 'required|url',
            'pubDate'     => 'required|date',
            'description' => 'required',
        );

        $data = array_merge(array('format' => $this->format), $this->channel);

        $validator = Validator::make($data, $rules);

        if($validator->passes()) {
            return true;
        }

        throw new FeederException($validator->errors()->first());
    }
}
