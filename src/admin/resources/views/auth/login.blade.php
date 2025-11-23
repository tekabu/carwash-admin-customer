<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('base.head')

<body>
	<!-- Page content -->
	<div class="page-content">
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Inner content -->
			<div class="content-inner">
				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">
					<!-- Login form -->
					<form class="login-form" action="{{ route('login.post') }}" method="post">
						<div class="card mb-0">
							<div class="card-body">
                                @session('error')
                                <div class="alert alert-danger border-0 alert-dismissible fade show">
									{{ $value }}
									<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							    </div>
                                @endsession

								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="{{ asset('images/logo.jpg') }}" class="h-48px" alt="" style="height: 5rem !important">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>

								<div class="mb-3">
									<label class="form-label">Email</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="email" class="form-control" placeholder="Email" name="email">
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="password" class="form-control" placeholder="•••••••••••" name="password">
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>
								
								<div class="mb-3">
									<button type="submit" class="btn btn-primary w-100">Login</button>
								</div>

								<!-- <div class="text-center">
									<a href="login_password_recover.html">Forgot password?</a>
								</div> -->
							</div>
						</div>
					</form>
					<!-- /login form -->
				</div>
				<!-- /content area -->
			</div>
			<!-- /inner content -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>
