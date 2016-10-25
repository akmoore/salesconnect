<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{!! $info['title'] !!}</title>

  <style type="text/css">
    /* Take care of image borders and formatting, client hacks */
    /*img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }*/


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 18px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }

    .mini-block {
      /*border: 1px solid #e5e5e5;*/
      /*border-radius: 5px;*/
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    /*.item {
      width: 300px;
    }*/

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  
</head>

<body>
<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%" style="position: relative; left: -42px;width:300px; margin-top: -30px">
  <tbody>
  <tr>
    <td align="center" valign="top" width="80%"" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="500" class="w320">
          <tbody><tr>
            <td class="header-lg">
              Production Order {{$info['year']}}
            </td>
          </tr>

          <tr>
            <td></td>
          </tr>

          <tr>
            <td class="w320">
              <table cellpadding="0" cellspacing="0" width="100%" style="position: relative;left: 10px;margin-top: 10px;">
                <tbody><tr>
                  <td class="mini-container-left">
                    <table cellpadding="0" cellspacing="0" width="90%">
                      <tbody><tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="90%" style="border-collapse:separate !important;">
                            <tbody><tr>
                              <td class="mini-block">
                                <strong>Agency:</strong> {{$info['agency']}}<br>
                                <strong>Advertiser:</strong> {{$info['advertiser']}}<br>
                                <strong>Salesperson:</strong>
                                  @foreach($info['salesperson'] as $ae)
                                    {{$ae}}
                                  @endforeach
                                <br>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                  <td class="mini-container-right">
                    <table cellpadding="0" cellspacing="0" width="90%">
                      <tbody><tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="90%" style="border-collapse:separate !important;">
                            <tbody><tr>
                              <td class="mini-block">
                                <strong>Date of Order:</strong> {{$info['date_of_order']}}<br>
                                <strong>Date Completed:</strong> {{$info['date_completed']}}<br>
                                <strong>Editor:</strong> {{$info['editor']}}<br>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td>
              <table cellpadding="0" cellspacing="0" width="457" class="w320" style="position: relative;left: 25px;box-sizing: border-box;">
                <tbody style="border: 1px solid #cccccc;">
                  <tr>
                    <td>
                      <table>
                        <tr>
                          <td style="text-align: left;padding: 10px 0px 0px 15px;" width="242" >
                            <span class="header-sm">Client's Info</span><br>
                            <strong>POC:</strong> {{$info['client_info']['poc']}}<br>
                            {{$info['client_info']['street']}}<br>
                            {{$info['client_info']['city'] . ','}} {{$info['client_info']['state']}} {{$info['client_info']['postal']}} <br>
                            {{$info['client_info']['poc_phone']}} <br>
                            {{$info['client_info']['poc_email']}}
                          </td>
                          <td  style="text-align: left;">
                            <span class="header-sm">Internal Data</span><br>
                            <strong>Manager:</strong> 
                              @foreach($info['internal_data']['manager'] as $manager)
                              {{$manager}}
                              @endforeach
                            <br>
                            <strong>Production Free:</strong> {{$info['internal_data']['production_free']}}<br> 
                            <strong>Promotional:</strong> {{$info['internal_data']['promotional']}}<br>
                            <strong>Produced By:</strong> {{$info['internal_data']['produced_by']}}
                          </td>
                        </tr>
                      </table>
                    </td>
                    
                  </tr>
                  <tr>
                    <td>
                      <table>
                        <tr>
                          <td width="457" style="padding: 15px 15px 10px 15px; text-align: left;">
                            <span class="header-sm">Description</span><br>
                            {{$info['description']}}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #ffffff;">
      <center>
        <table cellpadding="0" cellspacing="0" width="550" class="w320">
            <tbody><tr>
              <td class="item-table">
                <table cellspacing="0" cellpadding="0" width="90%" style="left: 10px;position: relative;">
                  <tbody><tr>
                    <td class="title-dark" >
                       Date
                    </td>
                    <td class="title-dark" width="163">
                       Description
                    </td>
                    <td class="title-dark">
                       Time/#
                    </td>
                    <td class="title-dark" >
                      Unit Rate
                    </td>
                    <td class="title-dark" width="97">
                      Total Charge
                    </td>
                  </tr>


                  <tr>
                    <td class="item-col item">
                      {{$info['table']['editing']['date']}}
                    </td>
                    <td class="item-col item">
                      Editing <small>(Premiere & After Effects)</small>
                    </td>
                    <td class="item-col item">
                      {{$info['table']['editing']['duration']}} {{str_plural('hr', $info['table']['editing']['duration'])}}
                    </td>
                    <td class="item-col quantity">
                      $150/hr
                    </td>
                    <td class="item-col price">
                      {{$info['table']['editing']['display_total_charge']}}
                    </td>
                  </tr>

                  <tr>
                    <td class="item-col item">
                      {{$info['table']['location']['date']}}
                    </td>
                    <td class="item-col item">
                      Location
                    </td>
                    <td class="item-col item">
                      {{$info['table']['location']['duration']}} {{str_plural('hr', $info['table']['location']['duration'])}}
                    </td>
                    <td class="item-col quantity">
                      $150/hr
                    </td>
                    <td class="item-col price">
                      {{$info['table']['location']['display_total_charge']}}
                    </td>
                  </tr>
                  
                  <tr>
                    <td class="item-col item">
                      {{$info['table']['dvd']['date']}}
                    </td>
                    <td class="item-col item">
                      DVD
                    </td>
                    <td class="item-col item">
                      {{$info['table']['dvd']['count']}}
                    </td>
                    <td class="item-col quantity">
                      $25
                    </td>
                    <td class="item-col price">
                      {{$info['table']['dvd']['display_total_charge']}}
                    </td>
                  </tr>

                  <tr>
                    <td class="item-col item">
                      {{$info['table']['crawl']['date']}}
                    </td>
                    <td class="item-col item">
                      Tag/Crawl/add Text
                    </td>
                    <td class="item-col item">
                      {{$info['table']['crawl']['count']}}
                    </td>
                    <td class="item-col quantity">
                      $50
                    </td>
                    <td class="item-col price">
                      {{$info['table']['crawl']['display_total_charge']}}
                    </td>
                  </tr>

                  <tr>
                    <td class="item-col item">
                      {{$info['table']['green_screen']['date']}}
                    </td>
                    <td class="item-col item">
                      Green Screen
                    </td>
                    <td class="item-col item">
                      {{$info['table']['green_screen']['duration']}}  {{str_plural('hr', $info['table']['green_screen']['duration'])}}
                    </td>
                    <td class="item-col quantity">
                      $150
                    </td>
                    <td class="item-col price">
                      {{$info['table']['green_screen']['display_total_charge']}}
                    </td>
                  </tr>

                  <tr>
                    <td class="item-col item">
                      {{$info['table']['music_library']['date']}}
                    </td>
                    <td class="item-col item">
                      Music Library
                    </td>
                    <td class="item-col item">
                      {{$info['table']['music_library']['count']}}
                    </td>
                    <td class="item-col quantity">
                      $25
                    </td>
                    <td class="item-col price">
                      {{$info['table']['music_library']['display_total_charge']}}
                    </td>
                  </tr>

                  <tr>
                    <td class="item-col item mobile-row-padding"></td>
                    <td class="item-col quantity"></td>
                    <td class="item-col price"></td>
                  </tr>


                  <tr>
                    <td class="item-col item"></td>
                    <td class="item-col item"></td>
                    <td class="item-col item"></td>
                    <td class="item-col quantity" style="text-align:right; padding-right: 10px; border-top: 1px solid #cccccc;">
                      <span class="total-space">Total Work:</span> <br>
                      <span class="total-space">Sub Total:</span>  <br>
                      <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total:</span>
                    </td>
                    <td class="item-col price" style="text-align: left; border-top: 1px solid #cccccc;">
                      <span class="total-space">
                        {{$info['table']['display_total_work_amount']}}
                      </span> <br>
                      <span class="total-space">$</span>  <br>
                      <span class="total-space" style="font-weight:bold; color: #4d4d4d">$</span>
                    </td>
                </tr></tbody></table>
              </td>
            </tr>
        </tbody></table>
      </center>
    </td>
  </tr>
  <!-- <tr>
    <td align="center" valign="top" width="100%" height: 100px;">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tbody><tr>
            <td style="padding: 25px 0 25px">
              <strong>Awesome Inc</strong><br>
              1234 Awesome St <br>
              Wonderland <br><br>
            </td>
          </tr>
        </tbody></table>
      </center>
    </td>
  </tr> -->
</tbody></table>


</body></html>