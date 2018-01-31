<!DOCTYPE html>
<html>
<head>
    <meta property="fb:app_id" content="{{ $json_cu_variabile['fbappid'] }}" />
    <meta property="og:site_name" content="{{ $json_cu_variabile['sitename'] }}">
    <meta property="og:description" content="{{ $appset['fbdescription'] }}">
    <meta property="og:title" content="{{ $appset['fbtitle'] }}">
    <meta property="og:url" content="{{ url() }}/{{ $aplicatie->appname }}/media/{{ $input['id'] }}-{{ $input['result'] }}">
    @if($appset['fbimage'] == 'mainimage')
        <meta property="og:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    @else
        <meta property="og:image" content="{{ url() }}/{{ $aplicatie->appname }}/media-image/{{ $input['fbid'] }}-{{ $input['gender'] }}-{{ urlencode($input['fullname']) }}-{{ urlencode($input['firstname']) }}-{{ urlencode($input['lastname']) }}-{{ $input['result'] }}.jpg"/>
    @endif
    <meta property="og:image:height" content="446">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="850">
    <meta property="og:image:type" content="image/jpeg">

    <meta property="twitter:meta_title" content="{{ $appset['fbtitle'] }}">
    <meta property="twitter:description" content="{{ $appset['fbdescription'] }}">
    @if($appset['fbimage'] == 'mainimage')
        <meta name="twitter:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    @else
        <meta name="twitter:image" content="{{ url() }}/{{ $aplicatie->appname }}/media-image/{{ $input['fbid'] }}-{{ $input['gender'] }}-{{ urlencode($input['fullname']) }}-{{ urlencode($input['firstname']) }}-{{ urlencode($input['lastname']) }}-{{ $input['result'] }}.jpg"/>
    @endif
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image:height" content="446">
    <meta property="twitter:image:width" content="850">

    <meta http-equiv="refresh" content="0; url={{ url() }}/{{ $aplicatie->appname }}" />
</head>
</html>