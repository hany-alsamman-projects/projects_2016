{{ '<?xml version="1.0" encoding="UTF-8" ?>'."\n" }}
<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="html">{{{ $channel['title'] }}}</title>
    <subtitle type="html"><![CDATA[{{ $channel['description'] }}]]></subtitle>
    <link href="{{{ $channel['link'] }}}"></link>
    <id>{{{ $channel['link'] }}}</id>
    <link rel="alternate" type="text/html" href="{{{ $channel['link'] }}}" ></link>
    <link rel="self" type="application/xml" href="{{{ Request::url() }}}" ></link>
@if (!empty($channel['logo']))
    <logo>{{{ $channe['logo'] }}}</logo>
@endif
@if (!empty($channel['icon']))
    <icon>{{{ $channel['icon'] }}}</icon>
@endif
    <updated>{{{ $channel['pubDate'] }}}</updated>
@foreach($items as $item)
    <entry>
        <author>
            <name>{{{ $item['author'] }}}</name>
        </author>
        <title type="html"><![CDATA[{{ $item['title'] }}]]></title>
        <link rel="alternate" type="text/html" href="{{{ $item['link'] }}}"></link>
        <id>{{{ $item['link'] }}}</id>
        <summary type="html"><![CDATA[{{ $item['description'] }}]]></summary>
        <updated>{{{ $item['pubDate'] }}}</updated>
    </entry>
@endforeach
</feed>
