@extends('layout/quixlab_auth')
@section('title', 'Admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#message">Message</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task</th>
                                            <th scope="col">Progress</th>
                                            <th scope="col">Deadline</th>
                                            <th scope="col">Label</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Air Conditioner</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Apr 20,2018</td>
                                            <td><span class="label gradient-1 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Textiles</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>May 27,2018</td>
                                            <td><span class="label gradient-2 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Milk Powder</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-3" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>May 18,2018</td>
                                            <td><span class="label gradient-3 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vehicles</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-4" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Mar 27,2018</td>
                                            <td><span class="label gradient-4 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Boats</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-9" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Jun 28,2018</td>
                                            <td><span class="label gradient-9 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Boats</td>
                                            <td>
                                                <div class="progress" style="height: 10px">
                                                    <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Aug 20,2018</td>
                                            <td><span class="label gradient-2 btn-rounded">70%</span>
                                            </td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                        </div>
                        <div class="tab-pane fade" id="contact">
                            <div class="p-t-15">
                                <h4>This is contact title</h4>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="message">
                            <div class="p-t-15">
                                <h4>This is message title</h4>
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
