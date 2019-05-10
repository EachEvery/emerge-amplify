@extends('email')
@section('title', 'Poem | Emerge')
@section('content')

<table cellpadding="0" cellspacing="0" border="0" align="center" id="wrapperTable" width="600" style="margin: 40px auto 0px auto; width: 600px; border-bottom: 0; background-color: {{ $color }}; padding: 60px; padding-bottom: 0;" cellpadding="60"><tr><td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
    <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">
        <tr>
            <td width="480" align="center" style="text-align: center; width: 480px; font-family: Georgia, serif; font-weight: lighter; font-size: 20px; line-height: 40px; color: #ffffff; padding: 0 20px;">
            	{{ $content }}
            </td>
        </tr>
    </table>
</td></tr></table>

<table cellpadding="0" cellspacing="0" border="0" align="center" id="wrapperTable" width="600" style="margin: 0 auto 0px auto; width: 600px; border-bottom: 0; background-color: {{ $color }}; padding: 60px;" cellpadding="60"><tr><td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
    <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">
        <tr>
            <td width="480" style="width: 480px;">
                <img src="{{ $poem->photo_url }}" width="480" style="width: 480px;" alt="{{ $poem->title }}" />
            </td>
        </tr>
    </table>
    @if(!empty($note ?? null))
        <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="margin: 40px auto 0px auto; width: 480px;">
            <tr>
                <td width="480" align="center" style="text-align: center; width: 480px; font-family: Georgia, serif; font-weight: lighter; font-size: 20px; line-height: 40px; color: #ffffff; padding: 0 20px;">
                    Note: {{ $note }}
                </td>
            </tr>
        </table>
    @endif
    <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="margin: 40px auto 0px auto; width: 480px;">
        <tr>
            <td width="480" align="center" style="text-align: center; width: 480px; line-height: 40px; padding: 0 20px;">
                <a href="{{$poem->public_url}}" target="_blank" style="font-size: 20px; font-family: Georgia, serif; font-weight: lighter; text-decoration: none; color: #ffffff;">
                    View Poem Online &rarr;
                </a>
            </td>
        </tr>
    </table>
</td></tr></table>
@endsection