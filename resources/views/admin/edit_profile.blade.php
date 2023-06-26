@extends('layouts.master_apply')

@section('content')

    <!-- if the application has been accepted  -->
    @if(auth()->user()->completed == 14)
        <!-- if the application has been accepted  -->
        

            @if($studyApplication)

                <!-- if study applicant  -->

                @if(auth()->user()->student->date_reported == NULL)

                    <div class="alert alert-success">
                        <i class=" fas fa-fw fa-check" aria-hidden="true"></i>

                                <!-- if the accepted student has not reported yet  -->
                                @if($studentReportingPeriod)

                                    <!-- if the students reporting period has been set  -->
                                    Your application has been accepted, please report between {{optional($studentReportingPeriod)->from_date}} and {{optional($studentReportingPeriod)->to_date}}!

                                @else

                                    <!-- if the students reporting period has not been set  -->
                                    Your application has been accepted, please report as soon as possible!

                                @endif

                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    
                @endif

            @elseif($jobApplication)

                <!-- if job applicant  -->
                @if(auth()->user()->employee->date_reported == NULL)

                    <div class="alert alert-success">
                        <i class=" fas fa-fw fa-check" aria-hidden="true"></i>

                                <!-- if the hired staff has not reported yet  -->
                                @if($staffReportingPeriod)

                                    <!-- if the hired staffs reporting period has been set  -->
                                    Your job application has been accepted, please report between {{optional($staffReportingPeriod)->from_date}} and {{optional($staffReportingPeriod)->to_date}}!
                                @else

                                    <!-- if the hired staffs reporting period has not been set  -->
                                    Your job application has been accepted, please report as soon as possible!

                                @endif

                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    
                @endif

                

            @endif

            
    @endif

<!-- if the application has not been accepted  -->
    @if(auth()->user()->completed == 13)
    <div class="alert alert-danger">
            <i class=" fas fa-fw fa-check" aria-hidden="true"></i>
            Your application has not been approved yet!

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check" aria-hidden="true"></i>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }} <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
</button></li>
            
        @endforeach
    </ul>
@endif

<div id="js-alert"></div>

<!-- main-card  -->

<div class="card" style="padding: 0px;margin: 2% 0px 0px 0px;">

    <!-- main-card-header  -->

    <div class="card-header">
    
        <h4 class="my-1 float-left"><i class="fas fa-settings" aria-hidden="true"></i>&nbsp;Edit Profile</h4>


        <div class="btn-group btn-group-sm float-right" role="group">
            <a href="{{ route('landing_apply') }}" class="btn btn-primary" title="Profile">
                <span class="fas fa-user-alt" aria-hidden="true"></span>
            </a>
        </div>

    </div>
    <!-- /.main-card-header  -->

    <!-- main-card-body  -->

    <div class="card-body" style="padding: 0px 0px 1% 0px;margin: 0px;">

    <div class="row"  style="padding: 0px;margin: 2% 15% 2% 15%;">
                @php

                    for($x = 1;$x< 13;$x++){
                        echo '<div id="step-'.$x.'" class="col-md-1 text-center" style="margin: 0px;padding: 1% 0px 0px 0px;border:2px solid orange;color: orange;border-radius: 100%;width: 60px;height: 60px;"><h1 >'.$x.'</h1></div>';
                    }

                @endphp
            </div>

            <div class="row" id="forms-row" style="margin: 0px;padding: 0px;">

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-1">
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">

                        <h5>1. Personal Information.</h5>

                        @if($userPersonalInfo == null)

                        <form method="POST" action="{{ route('admin.user_personal_infos.user_personal_info.store') }}" accept-charset="UTF-8" id="create_user_personal_info_form" name="create_user_personal_info_form" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_personal_infos.user_personal_info.update', $userPersonalInfo->id) }}" id="edit_user_birth_info_form" name="edit_user_birth_info_form" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                            {{ csrf_field() }}
                            @include ('admin.user_personal_infos.user_personal_infos.form', [
                                                        'userPersonalInfo' => ($userPersonalInfo == null)?null:$userPersonalInfo,
                                                    ])

                                <div class="form-group">

                                    <div class="col-md-offset-2 col-md-10">
                                        <input class="btn btn-success" type="submit" value="Save">
                                    </div>

                                </div>
                                <!-- /.form-group  -->

                        </form>

                        <hr>
                        <h5>Birth Information.</h5>

                        @if($userBirthInfo == null)

                        <form method="POST" action="{{ route('admin.user_birth_infos.user_birth_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_birth_infos.user_birth_info.update', $userBirthInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif

                        {{ csrf_field() }}
                        @include ('admin.user_birth_infos.user_birth_infos.form', [
                                                    'userBirthInfo' => ($userBirthInfo == null)?null:$userBirthInfo,
                                                ])

                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Save">
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-2">

                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">

                    <h5>2. Father's Information.</h5>

                        @if($userFatherInfo == null)

                        <form method="POST" action="{{ route('admin.user_father_infos.user_father_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_father_infos.user_father_info.update', $userFatherInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                        {{ csrf_field() }}
                        @include ('admin.user_father_infos.user_father_infos.form', [
                                                    'userFatherInfo' => ($userFatherInfo == null)?null:$userFatherInfo,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-3">

                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>3. Mother's Information.</h5>

                    @if($userMotherInfo == null)

                    <form method="POST" action="{{ route('admin.user_mother_infos.user_mother_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                    @else

                    <form method="POST" action="{{ route('admin.user_mother_infos.user_mother_info.update', $userMotherInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    @endif

                        {{ csrf_field() }}
                        @include ('admin.user_mother_infos.user_mother_infos.form', [
                                                    'userMotherInfo' => ($userMotherInfo == null)?null:$userMotherInfo,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-4">

                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>4. Guardian's Information.</h5>

                    @if($userGuardianInfo == null)

                    <form method="POST" action="{{ route('admin.user_guardian_infos.user_guardian_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                    @else

                    <form method="POST" action="{{ route('admin.user_guardian_infos.user_guardian_info.update', $userGuardianInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                    <input name="_method" type="hidden" value="PUT">
                    @endif
                        {{ csrf_field() }}
                        @include ('admin.user_guardian_infos.user_guardian_infos.form', [
                                                    'userGuardianInfo' => ($userGuardianInfo == null)?null:$userGuardianInfo,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-5">
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>5. Residence Information.</h5>

                        @if($userResidenceInfo == null)

                        <form method="POST" action="{{ route('admin.user_residence_infos.user_residence_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_residence_infos.user_residence_info.update', $userResidenceInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif

                        {{ csrf_field() }}
                        @include ('admin.user_residence_infos.user_residence_infos.form', [
                                                    'userResidenceInfo' => ($userResidenceInfo == null)?null:$userResidenceInfo,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-6">
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>6. Education Information.</h5>
                            
                        @if($userEducationInfo == null)

                        <form method="POST" action="{{ route('admin.user_education_infos.user_education_info.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_education_infos.user_education_info.update', $userEducationInfo->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                              {{ csrf_field() }}
                        @include ('admin.user_education_infos.user_education_infos.form', [
                                                    'userEducationInfo' => ($userEducationInfo == null)?null:$userEducationInfo,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-7">
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>7. Skills.</h5>

                        @if($userSkill == null)

                        <form method="POST" action="{{ route('admin.user_skills.user_skill.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_skills.user_skill.update', $userSkill->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif

                        {{ csrf_field() }}
                        @include ('admin.user_skills.user_skills.form', [
                                                    'userSkill' => $userSkill,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                  <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-8">
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>8. Work Experience.</h5>

                        @if($userWorkExperience == null)

                        <form method="POST" action="{{ route('admin.user_work_experiences.user_work_experience.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_work_experiences.user_work_experience.update', $userWorkExperience->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                                {{ csrf_field() }}
                        @include ('admin.user_work_experiences.user_work_experiences.form', [
                                                    'userWorkExperience' => $userWorkExperience,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-9">
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>9. Disabilities.</h5>

                        @if($userDisability == null)

                        <form method="POST" action="{{ route('admin.user_disabilities.user_disability.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_disabilities.user_disability.update', $userDisability->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                        {{ csrf_field() }}
                        @include ('admin.user_disabilities.user_disabilities.form', [
                                                    'userDisability' => $userDisability,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-10">
                    
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>10. Chronic Diseases.</h5>

                    @if($userChronicDisease == null)

                        <form method="POST" action="{{ route('admin.user_chronic_diseases.user_chronic_disease.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_chronic_diseases.user_chronic_disease.update', $userChronicDisease->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                           {{ csrf_field() }}
                        @include ('admin.user_chronic_diseases.user_chronic_diseases.form', [
                                                    'userChronicDisease' => $userChronicDisease,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->
               

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-11">
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">
                    <h5>11. Hobbies.</h5>

                    @if($userHobby == null)

                        <form method="POST" action="{{ route('admin.user_hobbies.user_hobby.store') }}" accept-charset="UTF-8" class="form-horizontal">

                        @else

                        <form method="POST" action="{{ route('admin.user_hobbies.user_hobby.update', $userHobby->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        @endif
                         {{ csrf_field() }}
                        @include ('admin.user_hobbies.user_hobbies.form', [
                                                    'userHobby' => $userHobby,
                                                ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Save">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->

                <!-- col-md-12  -->
                <div class="col-md-12" id="step-div-12">
                    
                    <!-- card  -->
                    <div class="card" style="padding: 4%;margin-left: 15%;margin-right: 15%;">

                    <h5>12. Application Information.</h5>


                    </div>
                    <!-- /. card  -->
                </div>
                <!-- /.col-md-12  -->
                

            </div>
            <!-- /. row   -->

            <div class="row" style="margin-left: 17%;margin-right: 17%;">
                <div style="margin: 0px;padding: 0px;" class="col-md-6 text-left">
                    <a style="color: white;" id="prevBtn" class="btn btn-primary" >Previous</a>
                </div>
                <div style="margin: 0px;padding: 0px;" class="col-md-6 text-right">
                    <a style="color: white;" id="nextBtn" class="btn btn-primary" >Next</a>
                </div>
            </div>
            <!-- /.row  -->
    
    </div>
    <!-- /.main-card-body  -->

</div>
<!-- /.main-card  -->

@endsection
@section('js')
<script>
    $(document).ready(function (){

        var applyingUserStep = {!! json_encode($applyingUserStep) !!};

        if (applyingUserStep == 0) {
            $("#prevBtn").hide();
            $("#nextBtn").show(); 
        }else if(applyingUserStep > 12){
            $("#prevBtn").show();
            $("#nextBtn").hide(); 
        }else{
            $("#prevBtn").show();
            $("#nextBtn").show();
        }

        for (var index = 1; index < applyingUserStep; index++) {
           
            var stepIndicatorDiv = $('#step-'+index);
            stepIndicatorDiv.css({
                'background-color':'orange',
                'color':'white'
            });
            
        }

        var currentActiveDivCount;
        if (applyingUserStep == 0) {
            currentActiveDivCount = applyingUserStep + 1;   
        }else if(applyingUserStep == 14){
            currentActiveDivCount = applyingUserStep - 2; 
        }else{
            currentActiveDivCount = applyingUserStep;
        }

        var activeDiv = jQuery('#step-div-'+currentActiveDivCount);
       
        var x = 12;
        while (x > currentActiveDivCount){
            $('#step-div-'+x).hide();
            x--;
        }

        if(currentActiveDivCount > 1){

            var y = 1;
            while (y < currentActiveDivCount){
                $('#step-div-'+y).hide();
                y++;
            }

        }

        activeDiv.show();

        var VisibleDivId = jQuery('#forms-row div:visible').attr('id');
        var VisibleDivIdArray = VisibleDivId.split('-');
        var VisibleDivIndex = VisibleDivIdArray[2];
        var NextDivIndex = ++VisibleDivIndex;

        $("#nextBtn").click(function (){

            if (NextDivIndex <= currentActiveDivCount) {

                var stepNextDiv = jQuery('#step-div-'+NextDivIndex);
                var step = NextDivIndex;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepNextDiv.show();
                VisibleDivId = stepNextDiv.attr('id');
                VisibleDivIdArray = VisibleDivId.split('-');
                VisibleDivIndex = VisibleDivIdArray[2];
                NextDivIndex = ++VisibleDivIndex;
                $("#prevBtn").show();

                if(NextDivIndex == 13){
                    $("#nextBtn").hide();
                }else{
                    $("#nextBtn").show(); 
                }
                
            }

        });

        $("#prevBtn").click(function (){

            var PrevDivIndex = NextDivIndex;
            PrevDivIndex = PrevDivIndex - 2;

            var stepPrevDiv = jQuery('#step-div-'+PrevDivIndex);
            var prevStep = NextDivIndex;
            prevStep = prevStep - 1;

            var stepIndicatorDiv;
            // if(applyingUserStep < PrevDivIndex){
            //     stepIndicatorDiv = $('#step-'+prevStep);
            //     stepIndicatorDiv.css({
            //         'background-color':'#F4F6F9',
            //         'color':'orange'
            //     });
            // }
            

            var step = PrevDivIndex;

            var x = 12;
            while (x > step){
                $('#step-div-'+x).hide();
                x--;
            }

            if(step > 1){

                var y = 1;
                while (y < step){
                    $('#step-div-'+y).hide();
                    y++;
                }

            }

            stepPrevDiv.show();
            VisibleDivId = stepPrevDiv.attr('id');
            VisibleDivIdArray = VisibleDivId.split('-');
            VisibleDivIndex = VisibleDivIdArray[2];

            if(VisibleDivIndex > 1){
                PrevDivIndex = --VisibleDivIndex;
                VisibleDivIndex = VisibleDivIndex + 2;
            }else{
                PrevDivIndex = VisibleDivIndex;
                VisibleDivIndex++;
            }

            NextDivIndex = VisibleDivIndex;
            
            $("#nextBtn").show();

            if(NextDivIndex == 2){
                $("#prevBtn").hide();
            }else{
                $("#prevBtn").show(); 
            }

        });


        $("#step-1").click(function (){

            var stepOneDiv = jQuery('#step-div-1');
            var step = 1;
            var stepIndicatorDiv = $('#step-'+step);
            stepIndicatorDiv.css({
                'background-color':'orange',
                'color':'white'
            });
        
            var x = 12;
            while (x > step){
                $('#step-div-'+x).hide();
                x--;
            }

            stepOneDiv.show();
            NextDivIndex = 2;
            $("#prevBtn").hide();
            $("#nextBtn").show();

        });

        $("#step-2").click(function (){

            if (currentActiveDivCount >= 2) {

                var stepTwoDiv = jQuery('#step-div-2');
                var step = 2;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepTwoDiv.show();
                NextDivIndex = 3;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step one (1) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-3").click(function (){

            if (currentActiveDivCount >= 3) {

                var stepThreeDiv = jQuery('#step-div-3');
                var step = 3;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepThreeDiv.show();
                NextDivIndex = 4;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step two (2) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-4").click(function (){

            if (currentActiveDivCount >= 4) {

                var stepFourDiv = jQuery('#step-div-4');
                var step = 4;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepFourDiv.show();
                NextDivIndex = 5;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step three (3) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-5").click(function (){

            if (currentActiveDivCount >= 5) {

                var stepFiveDiv = jQuery('#step-div-5');
                var step = 5;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepFiveDiv.show();
                NextDivIndex = 6;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step four (4) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-6").click(function (){

            if (currentActiveDivCount >= 6) {

                var stepSixDiv = jQuery('#step-div-6');
                var step = 6;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepSixDiv.show();
                NextDivIndex = 7;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step five (5) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-7").click(function (){

            if (currentActiveDivCount >= 7) {

                var stepSevenDiv = jQuery('#step-div-7');
                var step = 7;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepSevenDiv.show();
                NextDivIndex = 8;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step six (6) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-8").click(function (){

            if (currentActiveDivCount >= 8) {

                var stepEightDiv = jQuery('#step-div-8');
                var step = 8;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepEightDiv.show();
                NextDivIndex = 9;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step seven (7) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-9").click(function (){

            if (currentActiveDivCount >= 9) {

                var stepNineDiv = jQuery('#step-div-9');
                var step = 9;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepNineDiv.show();
                NextDivIndex = 10;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step eight (8) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-10").click(function (){

            if (currentActiveDivCount >= 10) {

                var stepTenDiv = jQuery('#step-div-10');
                var step = 10;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepTenDiv.show();
                NextDivIndex = 11;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step nine (9) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-11").click(function (){

            if (currentActiveDivCount >= 11) {

                var stepElevenDiv = jQuery('#step-div-11');
                var step = 11;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepElevenDiv.show();
                NextDivIndex = 12;
                $("#prevBtn").show();
                $("#nextBtn").show();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step ten (10) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        $("#step-12").click(function (){

            if (currentActiveDivCount >= 12) {

                var stepTwelveDiv = jQuery('#step-div-12');
                var step = 12;
                var stepIndicatorDiv = $('#step-'+step);
                // stepIndicatorDiv.css({
                //     'background-color':'orange',
                //     'color':'white'
                // });
            
                var x = 12;
                while (x > step){
                    $('#step-div-'+x).hide();
                    x--;
                }

                if(step > 1){

                    var y = 1;
                    while (y < step){
                        $('#step-div-'+y).hide();
                        y++;
                    }

                }

                stepTwelveDiv.show();
                NextDivIndex = 13;
                $("#prevBtn").show();
                $("#nextBtn").hide();

            }else{
                $("#js-alert").html('<div class="alert alert-danger"><li>Please complete step eleven (11) first!<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button></li></div>');
            }

        });

        //AJAX TO GET DENOMINATIONS

        $(document).on('change', "#religion_id", function(){
            var religion_id = $("#religion_id").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.denominations.denomination.get_denominations') }}",
                method:"POST",
                data:{
                    religion_id:religion_id,
                    _token:_token
                },
                success:function ( response ){
                
                    $("#denomination_id").html(response.denominations);
                }
            });
        });

        //AJAX TO GET BIRTH REGIONS

        $(document).on('change', "#country_id_birth_infos", function(){
            var country_id = $("#country_id_birth_infos").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.region.get_regions') }}",
                method:"POST",
                data:{
                    country_id:country_id,
                    _token:_token
                },
                success:function ( response ){

                
                    $("#region_id_birth_infos").html(response.regions);
                    $("#district_id_birth_infos").html(response.districts);
                }
            });
        });


        //AJAX TO GET BIRTH DISTRICTS

        $(document).on('change', "#region_id_birth_infos", function(){
            var region_id = $("#region_id_birth_infos").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.district.get_district') }}",
                method:"POST",
                data:{
                    region_id:region_id,
                    _token:_token
                },
                success:function ( response ){

                    $("#district_id_birth_infos").html(response.districts);
                }
            });
        });


         //AJAX TO GET RESIDENCE REGIONS

         $(document).on('change', "#country_id_residence_infos", function(){
            var country_id = $("#country_id_residence_infos").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.region.get_regions') }}",
                method:"POST",
                data:{
                    country_id:country_id,
                    _token:_token
                },
                success:function ( response ){

                
                    $("#region_id_residence_infos").html(response.regions);
                    $("#district_id_residence_infos").html(response.districts);
                }
            });
        });


        //AJAX TO GET RESIDENCE DISTRICTS
        
        $(document).on('change', "#region_id_residence_infos", function(){
            var region_id = $("#region_id_residence_infos").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.district.get_district') }}",
                method:"POST",
                data:{
                    region_id:region_id,
                    _token:_token
                },
                success:function ( response ){

                    $("#district_id_residence_infos").html(response.districts);
                }
            });
        });
        
        $(document).on('change', "#application_type_id", function(){
            var application_type_id = $("#application_type_id").val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{ route('admin.posts.post.get_posts') }}",
                method:"POST",
                data:{
                    application_type_id:application_type_id,
                    _token:_token
                },
                success:function ( response ){
                    $("#post_id").html(response.posts);
                }
            });
        });
      
       

    });

    
</script>
@endsection
