@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{__('message.home')}}
@endsection

@section('main-content')
	<h1 class="centered">
		Liste des Cours : {{ Auth::user()->domain }}
		<small>13 courses</small>
	</h1>


	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<a href="{{route('cours.create')}}" class="btn btn-primary btn-block margin-bottom">Créer Nouveau Cours</a>

				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Folders</h3>

						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li class="active"><a href="#"><i class="fa fa-folder"></i> Mes Cours
									<span class="label label-primary pull-right">12</span></a></li>
							<li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
							<li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
							</li>
							<li><a href="#"><i class="fa fa-trash-o"></i> Corbeille</a></li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /. box -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Labels</h3>

						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
							<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
							<li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Mes Cours</h3>

						<div class="box-tools pull-right">
							<div class="has-feedback">
								<input type="text" class="form-control input-sm" placeholder="Search Mail">
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
							</div>
						</div>
						<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="mailbox-controls">
							<!-- Check all button -->
							<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
							</button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i></button>
							<!-- /.btn-group -->
							<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
							<div class="pull-right">
								1-50/200
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
									<button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
								</div>
								<!-- /.btn-group -->
							</div>
							<!-- /.pull-right -->
						</div>
						<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped">
								<tbody>


								<tr>
									<td><input type="checkbox"></td>
									<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
									<td class="mailbox-name"><a href="read-mail.html">Peterson Yuhala</a></td>
									<td class="mailbox-subject"><b><a href="read-mail.html">Introduction to CS</a></b> </td>
									<td class="mailbox-attachment">
											<button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
											<button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
									</td>
									<td class="mailbox-date">2 days ago</td>
								</tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Peterson Yuhala</a></td>
                                    <td class="mailbox-subject"><b><a href="read-mail.html">Introduction to CS</a></b> </td>
                                    <td class="mailbox-attachment">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <td class="mailbox-date">2 days ago</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Peterson Yuhala</a></td>
                                    <td class="mailbox-subject"><b><a href="read-mail.html">Introduction to CS</a></b> </td>
                                    <td class="mailbox-attachment">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <td class="mailbox-date">2 days ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                    <td class="mailbox-name"><a href="read-mail.html">Peterson Yuhala</a></td>
                                    <td class="mailbox-subject"><b><a href="read-mail.html">Introduction to CS</a></b> </td>
                                    <td class="mailbox-attachment">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <td class="mailbox-date">2 days ago</td>
                                </tr>

                                </tbody>
							</table>
							<!-- /.table -->

						</div>
						<!-- /.mail-box-messages -->

					</div>
					<!-- /.box-body -->
					<div class="box-footer no-padding">
							<!-- Check all button -->
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-download"></i></button>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                <div class="pull-right">
                                    1-50/200
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
							<!-- /.pull-right -->

					</div>
				</div>
				<!-- /. box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

@endsection
