<?php 
// WARNING, this is a read only file created by import scripts
// WARNING
// WARNING,  Changes made to this file will be clobbered
// WARNING
// WARNING,  Please make changes on poeditor instead of here
// 
// 
?>
subject: Guest ended to upload files

{alternative:plain}

Dear Sir or Madam,

The following guest ended file uploads using a guest voucher:

Guest: {guest.email}
Voucher link: {cfg:site_url}?s=upload&vid={guest.token}

The voucher is available until {date:guest.expires} after which time it will be automatically deleted.

Best regards,
{cfg:site_name}

{alternative:html}

<table style="width:800" align="left" border="4" padding="40">
<tr><td><img src="{cfg:site_url}images/banner800.png" alt="SURFfilesender Logo" />

<p style="font-family:Arial, sans-serif; font-size:14px; text-decoration:none; font-style:normal">
The following guest ended file uploads using a guest voucher :
</p>

<table rules="rows">
    <thead>
        <tr>
            <th colspan="2">Voucher details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Guest</td>
            <td><a href="mailto:{guest.email}">{guest.email}</a></td>
        </tr>
        <tr>
            <td>Voucher link</td>
            <td><a href="{cfg:site_url}?s=upload&vid={guest.token}">{cfg:site_url}?s=upload&vid={guest.token}</a></td>
        </tr>
        <tr>
            <td>Valid until</td>
            <td>{date:guest.expires}</td>
        </tr>
    </tbody>
</table>

</td></tr>

 <tr style="border-style:none">
    <td align="center">
       <p style="font-size:12px; text-decoration:none">
       More information about the SURFfilesender service can be found at
       <a rel="nofollow" href="https://www.surffilesender.nl/en/" target="_blank">www.surffilesender.nl/en</a>
       </p>
       <p style="font-size:10px; text-decoration:none"> SURFfilesender is powered by <a rel="nofollow" href="https://www.surf.nl/en/" target="_blank">SURF</a>.
       </p>
    </td>
</tr>
</table>
