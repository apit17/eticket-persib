@extends('backend.layout.layout')

@section('content')
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<i class="icon-reorder shaded"></i>
			</a>

		  	<a class="brand" href="">
		  		<img src="{!! asset('asset/images/lipstik.png') !!}" width="120" height="120"><font size="6" color="#AC124C"> Kissproof ID</font>
		  	</a>
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->

<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="module module-login span4 offset4">
				<form method="POST" class="form-vertical" action="{{URL::to('login')}}" accept-charset="UTF-8" id="login" name="login">
					<div class="module-head">
						<h3>Sign In to System</h3>
					</div>
					<div class="module-body">
						<div class="control-group">
							<div class="controls row-fluid">
								<input name="email" class="span12" type="text" id="inputEmail" placeholder="Email" required>
							</div>
						</div>
						<div class="control-group">
							<div class="controls row-fluid">
								<input name="password" class="span12" type="password" id="inputPassword" placeholder="Password" required>
							</div>
						</div>
					</div>
					<div class="module-foot">
						<div class="control-group">
							<div class="controls clearfix">
								<button type="submit" class="btn btn-default pull-right">Login</button>
								<label class="checkbox">
									<input type="checkbox" name="rememberme"> Remember me
								</label>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--/.wrapper-->
@stop