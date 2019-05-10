<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Emerge')</title>
    <!--[if gte mso 9]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <style type="text/css">

        /***********
        Originally based on The MailChimp Reset from Fabio Carneiro, MailChimp User Experience Design
        More info and templates on Github: https://github.com/mailchimp/Email-Blueprints
        http://www.mailchimp.com &amp; http://www.fabio-carneiro.com

        INLINE: Yes.
        ***********/
        /* Client-specific Styles */
        #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
        .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
        /* End reset */

        /***************************************************
        ****************************************************
        MOBILE TARGETING

        Use @media queries with care.  You should not bring these styles inline -- so it's recommended to apply them AFTER you bring the other stlying inline.

        Note: test carefully with Yahoo.
        Note 2: Don't bring anything below this line inline.
        ****************************************************
        ***************************************************/

        /* NOTE: To properly use @media queries and play nice with yahoo mail, use attribute selectors in place of class, id declarations.
        table[class=classname]
        Read more: http://www.campaignmonitor.com/blog/post/3457/media-query-issues-in-yahoo-mail-mobile-email/
        */
        div, p, a, li, td { -webkit-text-size-adjust:none; }
            
        @media only screen and (max-device-width: 480px) {
            [id*="wrapperTable"] {
                margin-bottom: 0 !important
            }
            [class*="mobile320"] {
                width: 320px !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            [class*="mobile280"] {
                width: 280px !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            [class*="mobile400"] {
                width: 400px !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            [class*="mobileFullWidth"] {
                width: 100% !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            [class*="mobileCollapse"] {
                display: block !important;
            }
            [class*="mobileHide"] {
                display: none !important;
            }
            [class*="mobileNoBorder"] {
                border: none !important;
            }
            [class*="mobileNoPadding"] {
                padding: 0 !important;
            }
            [class*="mobileBackgroundWhite"] {
                background: #fff !important;
            }
            [class*="mobileBackgroundRed"] {
                background: #ed4448 !important;
            }
            [class*="mobileBackgroundGrey"] {
                background: #e8ecf0 !important;
            }
            [class*="mobileFontBump"] {
                font-size: 22px !important;
                line-height: 1.5 !important;
                margin-bottom: 20px !important;
            }
            [class*="mobileCenter"] {
                text-align: center !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            [class*="mobilePaddingBottom20px"] {
                padding-bottom: 20px !important;
            }
            [class*="mobileHeightAuto"] {
                height: auto !important;
            }
            img {
                max-width: 100%;
            }
            [id="preHeader"] {
                font-size: 8px !important;
            }
            [id="heroTable"] {
                border-top: 20px solid #fff !important;
            }
            [class*="heroImageContainer"] {
                overflow: hidden;
                margin-top: 20px;
            }
            [class*="heroImage"] {
                width: 280px;
                margin: -2px auto 0 auto;
            }
            [class*="contentBlock"] h2 {
                font-size: 27px !important;
                line-height: 32px !important;
                margin: 0 !important;
            }
            [class*="contentIcon"] {
                display: block;
                padding: 20px 0 0 0 !important;
                width: 162px !important;
                margin: 0 auto !important;
                text-align: center;
            }
            [class*="contentIcon"] img {
                width: 250px !important;
                height: auto !important;
            }
            [class*="columnRightContainer"] {
                padding-top: 20px !important;
            }
            [id="backgroundTable"] {
                padding: 0 !important;
                width: 100% !important;
            }
            [id="wrapperTable"] {
                width: 100% !important;
                margin-top: 0 !important;
            }            
        }
    </style>

    <!-- Targeting Windows Mobile -->
    <!--[if IEMobile 7]>
    <style type="text/css">

    </style>
    <![endif]-->

    <!-- ***********************************************
    ****************************************************
    END MOBILE TARGETING
    ****************************************************
    ************************************************ -->

    <!--[if gte mso 9]>
    <style>
        /* Target Outlook 2007 and 2010 */
    </style>
    <![endif]-->
</head>
<body style="background-color: #eeeeee; margin: 0; padding: 0;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" id="backgroundTable" style="margin: 0; padding: 0 20px; width: 100% !important; background-color: #eeeeee; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px !important; color: #898989;"><tr><td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
        @yield('content')
        <table cellpadding="0" cellspacing="0" border="0" align="center" id="wrapperTable" width="600" style="margin: 0px auto 70px auto; width: 600px; border: 1px solid #898989; background-color: #ffffff; padding: 30px; border-top: 0;" cellpadding="30"><tr><td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">    
            <table width="480" height="27" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 27px; border-top: 3px solid #a6a8ac; margin-top: 20px;">                
                <tr>                            
                    <td width="480" style="width: 480px; font-family: Arial, sans-serif; font-weight: bold; font-size: 14px; line-height: 22px; color: #a6a8ac; padding-top: 5px">
                        ABOUT EMERGE
                    </td>
                </tr>                
            </table>   

            <table width="480" height="35" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 35px;">                
                <tr>                            
                    <td>&nbsp;</td>
                </tr>                
            </table>                     
            
            <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">                
                <tr>                            
                    <td width="480" height="154" style="width: 480px; height: 154px; font-family: Georgia, serif; font-style: italic; font-size: 14px; line-height: 22px; color: #252525;">
                        With major support from the John S. and James L. Knight Foundation, Traveling Stanzas is a project of the College of Arts and Sciences’ Wick Poetry Center at Kent State University in collaboration with Visual Communication Design students and alumni.    
                        <br />
                        <br />
                        The purpose of Traveling Stanzas is to facilitate a global conversation through the intimate and inclusive voice of poetry.
                    </td>
                </tr>                
            </table>
            
            <table width="480" height="40" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 40px;">                
                <tr>                            
                    <td>&nbsp;</td>
                </tr>                
            </table>   

            <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">                
                <tr>                            
                    <td width="145" height="9" style="width: 145px; height: 9px; border: 0;" border="0">
                        <a href="http://www.travelingstanzas.com/en/home/" target="_blank" style="font-size: 14px; font-family: Arial, sans-serif; font-weight: bold; text-decoration: none; color: {{ $color }};">
                            VISIT OUR WEBSITE &rarr;
                        </a>
                    </td>
                </tr>                
            </table>

            <table width="480" height="10" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 10px;">                
                <tr>                            
                    <td>&nbsp;</td>
                </tr>                
            </table>   

            <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">                
                <tr>                            
                    <td width="69" height="9" style="width: 69px; height: 9px; border: 0;" border="0">
                        <a href="https://secure2.convio.net/ksu/site/Donation2?df_id=2620&2620.donation=form1" target="_blank" style="font-size: 14px; font-family: Arial, sans-serif; font-weight: bold; text-decoration: none; color: {{ $color }};">
                            DONATE &rarr;
                        </a>
                    </td>
                </tr>                
            </table>

            <table width="480" height="125" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 125px;">                
                <tr>                            
                    <td>&nbsp;</td>
                </tr>                
            </table>  

            <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">                
                <tr>        

                    <td width="103.5" height="48" style="width: 103.5px; height: 48px; border: 0;" border="0">
                        <a href="http://www.kent.edu/" target="_blank">
                            <img src="https://gallery.mailchimp.com/d56ae7eb136438613e7a708c4/images/da7d010b-163a-40f6-8284-4d7f51cbbb14.gif" width="103.5" height="48" style="border: 0; width: 103.5px; height: 48px;" alt="Kent State University" /> 
                        </a>
                    </td>

                    <td width="103.5" height="48" style="width: 103.5px; height: 48px; border: 0;" border="0">
                        <a href="https://www.kent.edu/wick" target="_blank">
                            <img src="https://gallery.mailchimp.com/d56ae7eb136438613e7a708c4/images/220998bf-92ad-42d6-9261-befe9bf72a22.gif" width="103.5" height="48" style="border: 0; width: 103.5px; height: 48px;" alt="Wick Poetry Center" /> 
                        </a>
                    </td>

                    <td width="163" height="48" style="width: 163px; height: 48px; border: 0;" border="0">
                        <a href="https://www.knightfoundation.org/communities/akron" target="_blank">
                            <img src="https://gallery.mailchimp.com/d56ae7eb136438613e7a708c4/images/69e9cb67-68aa-4a47-b3ba-21983cd73fda.gif" width="163" height="48" style="border: 0; width: 163px; height: 48px;" alt="Knight Foundation" /> 
                        </a>
                    </td>

                    <td width="108" height="48" style="width: 108px; height: 48px; border: 0;" border="0">
                        <a href="http://www.oac.ohio.gov/" target="_blank">
                            <img src="https://gallery.mailchimp.com/d56ae7eb136438613e7a708c4/images/3294f320-5f5b-48ae-9729-1a52e874e2cb.gif" width="108" height="48" style="border: 0; width: 108px; height: 48px;" alt="Ohio Arts Council" /> 
                        </a>
                    </td>

                </tr>                
            </table>

            <table width="480" height="30" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px; height: 30px;">                
                <tr>                            
                    <td>&nbsp;</td>
                </tr>                
            </table>  


            <table width="480" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 480px;">                
                <tr>                            
                    <td width="480" height="30" style="width: 480px; height: 30px; font-family: Arial, sans-serif; font-weight: lighter; font-size: 9px; line-height: 15px; color: #a6a8ac;">
                        This email was sent because someone sent a poem from a form at the Traveling Stanzas Exhibit. If you believe you have received this email in error, please email <a href="mailto:contact@travelingstanzas.com" style="text-decoration: none; color: {{ $color }}">contact@travelingstanzas.com</a>.     
                    </td>
                </tr>                
            </table>
        

        </td></tr></table><!-- #wrapperTable -->
    </td></tr></table><!-- #backgroundTable -->
</body>
</html>