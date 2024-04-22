<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0"
    style="font-size: 14px; font-family: 'Microsoft Yahei', Arial, Helvetica, sans-serif; padding: 0px; margin: 0px; color: rgb(51, 51, 51); background-image: url(''); background-color: rgb(247, 247, 247); background-repeat: repeat-x; background-position: 0% 100%;">
    <tbody>
        <tr>
            <td>
                <table style="width:100%; max-width:600px;" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <div style="padding: 0px 30px; background: rgb(255, 255, 255);">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom: 20px;">
                                                    Dear {{ $dataUser->name }},
                                                    <p>Your password has be updated</p>
                                                    <p>This Your New Password : <b>{{ $dataUser->new_pass }}</b> <br />
                                                        <br />
                                                    </p>
                                                    <p>Klik
                                                        <a href="{{ $dataUser->link_login }}">this link</a>, for login
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 20px;">
                                                    Sincerely,<br />
                                                    Tk Nirarta.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </td>
        </tr>
    </tbody>
</table>
