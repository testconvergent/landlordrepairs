<!DOCTYPE html>
<html>
<head>
    <title>{{$quote_details->tradesman_name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
    <div style="width:600px; margin:0 auto; background:#f2f2f2; overflow:hidden; padding:0 0 40px 0;">
        <!--HEADER AREA-->
        <div style="width:100%; background:#f2f2f2; padding: 25px 0 20px 0;">
            <div style="float: none; text-align: center;">
                <img src="images/logo.png" alt="" width="240px;" style="margin:0 auto;">
            </div>
        </div>
        <!--HEADER AREA END-->
        <div style="width:520px; margin:0 auto; background:#FFF; overflow:hidden;">
            <!--medial area start-->
            <div style="overflow:hidden; margin-bottom: 5px; padding: 25px;">

                <h2 style="font-family: 'Open Sans', sans-serif; font-size:21px; font-weight:700; color:#333; margin: 0 0 22px 0;">Hi, {{$quote_details->customer_name}}</h2>

                <div style="background: #f1f1f1; display:block; overflow:hidden; width:100%; height:1px;"></div>

                <div style="display:block; overflow:hidden; width:100%; margin:20px 0 20px 0;">
					<div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><p> {{$quote_details->tradesman_name}} has been sent a proposal for the {{$quote_details->looking_for}}.</p>
                    </div>
                    <div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><strong>Job Category :</strong> {{$quote_details->category}}</p>
                    </div>

                    <div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><strong>Job Type :</strong> {{$quote_details->job_type}}</p>
                    </div>
                </div>

                <div style="font-family: 'Open Sans', sans-serif;  font-size:15px; font-weight:400; color:#333; line-height:22px;">
				{{$quote_details->proposal_description}}
                </div>

                <div style="display:block; overflow:hidden; width:100%; margin:20px 0 20px 0;">
                    <div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><strong>Proposal price :</strong> ${{$quote_details->proposed_price}}</p>
                    </div>

                    <div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><strong>Start date :</strong> {{$quote_details->proposed_date}}</p>
                    </div>

                    <div style="font-family: 'Open Sans', sans-serif; float:left; font-size:15px; font-weight:400; color:#333; display:block; overflow:hidden; width:100%;">
                        <p style="margin:0 0 8px 0; float:left;"><strong>From :</strong> {{$quote_details->tradesman_name}}</p>
                    </div>
                </div>

                <div style="background: #f1f1f1; display:block; overflow:hidden; width:100%; height:1px;"></div>

                <p style="font-family: 'Open Sans', sans-serif; font-size:15px; font-weight:600; color:#333; margin:25px 0 3px 0;">Thank you</p>
                <p style="font-family: 'Open Sans', sans-serif; font-size:15px; font-weight:600; color:#333; margin:0 0 3px 0;">LandLordRepairs team</p>

            </div>
        </div>
    </div>
</body>
</html>