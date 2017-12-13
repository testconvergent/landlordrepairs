@extends('admin.layout.app')
@section('title','Tradesmen Details')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Tradesmen Details</h4>
								<div class="submit-login pull-right">
									<a href="admin-tradesmen-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Personal Information</p>
												</div>
											</div>
											
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Name</strong>: {{@$user->user_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Email</strong>: {{@$user->email}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Mobile Number</strong>: {{@$user->mobile}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Category</strong>: {{@$user->category_name}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Business Type</strong>: @if(@$user->business_type == 1)Partner @else Provider @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Post Code</strong>: {{@$user->post_code}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Address</strong>: {{@$user->address}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Years in Biz</strong>: {{@$user->year_in_biz}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Qualification</strong>: {{@$user->qualification}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Qualification</strong>: {{@$user->qualification}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Emergency Job</strong>: @if(@$user->emergency_job == 1)Yes @else No @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Insurance</strong>: @if(@$user->insurance == 1)Yes @else No @endif</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Team</strong>: {{@$user->team_members}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Working Hours</strong>: {{@$user->working_hours}} </label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Status</strong>: 
													@if($user->is_email_verified == 0 && $user->user_status == 0){{'Email Not Verified'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 1){{'Active'}}
													
													@elseif($user->is_email_verified == 1 && $user->user_status == 2){{'Inactive'}}
													@endif
													</label>
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Registration Date</strong>:
													@if(@$user->registration_date)
													{{date('d-m-Y'),strtotime(@$user->registration_date)}} @endif</label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Profile Description</p>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Profile Title</strong>: {{@$user->prof_title}} </label>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
												<div class="your-mail">
													<label for="exampleInputEmail1"><strong>Profile Description</strong>: {{@$user->prof_description}} </label>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Portfolio</p>
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="info_ii">
													<p>Logo</p>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div><!-- End Row -->
                    </div> <!-- container -->       
                </div> <!-- content -->
            </div>
        </div>
@endsection   