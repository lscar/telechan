<!DOCTYPE html>
<html lang="zh">
<head>
    <title>DailyBonusMail</title>
</head>
<body>

@markdown('## Summary')

@markdown
@foreach($summary as $item)
{{'- ' .  $item}}
@endforeach
@endmarkdown

@markdown('## Detail')

@markdown
@foreach($detail as $item)
{{'- ' . $item}}
@endforeach
@endmarkdown

</body>