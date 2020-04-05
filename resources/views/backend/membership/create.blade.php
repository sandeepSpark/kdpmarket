@extends('layouts.backend.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->

    <div class="row">
        <div class="col-lg-10">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Grayscale Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Member Registration 등록화면 설명
                    </h6>
                </div>
                <div class="card-body">
                    <form class="memberRegistration" action="{{ route('membership.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="rID">ID</label>
                                    <input type="text" class="form-control" name="userID" id="userID"
                                        aria-describedby="rID" placeholder="회원 ID (6자리이상)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rName">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="회원이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rPhone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        aria-describedby="rPhone" placeholder="전화번호">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rEmail">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="rEmail" placeholder="이메일 주소">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rDname">Depositor Name</label>
                                    <input type="text" class="form-control" name="deposit_name" id="deposit_name"
                                        aria-describedby="rDname" placeholder="입금자 이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rDtime">Deposite Date / Time</label>
                                    <input type="date" class="form-control" name="deposit_date" id="deposit_date"
                                        aria-describedby="rDtime" placeholder="입금일자 및 시간">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rVnumber">Voucher Number</label>
                                    <input type="text" class="form-control" name="voucher_no" id="voucher_no"
                                        aria-describedby="rVnumber" placeholder="상품권 번호">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rAowner">Account Owner</label>
                                    <input type="text" class="form-control" name="account_owner" id="account_owner"
                                        aria-describedby="rAowner" placeholder="예금주 이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rRRN">RRN (6자리-7자리)</label>
                                    <input type="text" class="form-control" name="rrn" id="rrn" aria-describedby="rRRN"
                                        placeholder="주민등록 번호 (6자리-7자리)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rBName">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name"
                                        aria-describedby="rBName" placeholder="은행이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rAcountNumber">Account Number</label>
                                    <input type="text" class="form-control" name="account_number" id="account_number"
                                        aria-describedby="rAcountNumber" placeholder="계좌번화">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="rRID" class="labelHighlight">Recruiter ID</label>
                                            <input type="text" class="form-control" name="recruiter_id"
                                                id="recruiter_id" aria-describedby="rRID" placeholder="모집인 ID">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        {{-- <label for="rCheckID">Check ID</label> --}}
                                        <button type="button" class="btn btn-info" id="rCheckID">Check</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rRecruiterName">Recruiter Name</label>
                                    <input type="text" class="form-control" name="recuriter_name" id="recuriter_name"
                                        aria-describedby="rRecruiterName" placeholder="모집인 이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            {{-- <label for="rSPID" class="labelHighlight">Sponsor ID</label> --}}
                                            <input type="text" class="form-control" name="sponsor_id" id="sponsor_id"
                                                aria-describedby="rSPID" placeholder="스폰서(후원인) ID">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        {{-- <label for="rCheckID">Check ID</label> --}}
                                        <button type="button" class="btn btn-info" id="rSponsorCheckID">Check</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rSpName">Sponsor Name</label>
                                    <input type="text" class="form-control" name="sponsor_name" id="sponsor_name"
                                        aria-describedby="rSpName" placeholder="스폰서(후원인) 이름">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="rID">Center Name</label>
                                            <select name="center_name" id="center_name" class="form-control">
                                                <option>select</option>
                                                @foreach ($companies as $company)
                                            <option value="{{$company->company_name}}" data-phone="{{$company->company_phone}}">{{$company->company_name}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" name="userID" id="userID"
                                                aria-describedby="rID" placeholder="회원 ID (6자리이상)"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="rCheckID"></label>
                                        <button type="button" class="btn btn-info" id="rCheckID">Check</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rCPhone">Center Phone</label>
                                    <input type="text" class="form-control" name="center_phone" id="center_phone"
                                        aria-describedby="rCPhone" placeholder="사업장(사무실) 전화번호)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Center Qualify</label>
                                <br><br>
                                <div class="form-row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="center_qualify"
                                            id="inlineRadio1" form-check-label" for="inlineRadio1" value="yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="center_qualify"
                                            id="inlineRadio2" form-check-label" for="inlineRadio2" value="no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="firstPasswordLogin">1st Password (Login)</label>
                                    <input type="text" class="form-control" name="first_password_login" id="first_password_login"
                                        aria-describedby="first_password" placeholder="1st Password (Login)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="firstPasswordLogin">2nd Password (E-wallet)</label>
                                    <input type="text" class="form-control" name="second_password_eWallet" id="second_password_eWallet"
                                        aria-describedby="second_password" placeholder="2nd Password (E-wallet)">
                                </div>
                            </div>
                            <!-- end of row -->
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit <i
                                class="fa fa-fw fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('#rCheckID').click(function(){
            var recruiter_id = $('#recruiter_id').val();
            $.ajax({
                type: "post",
                url: "{{route('checkRecruiterInfo')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: recruiter_id},
                success: function (data) {
                    // console.log(data);
                    if(data.count>=2) {
                    alert("Limit Reached !");
                    }else{
                    $('#recuriter_name').val(data.data[0].name);
                    }
                }
            });
        });

        $('#rSponsorCheckID').click(function(){
        var sponsor_id = $('#sponsor_id').val();
        $.ajax({
        type: "post",
        url: "{{route('checkRecruiterInfo')}}",
        data: {
        "_token": "{{ csrf_token() }}",
        id: sponsor_id},
        success: function (data) {
        if(data.count>=2) {
        alert("Limit Reached !");
        }else{
        $('#sponsor_name').val(data.data[0].name);
        }
        }
        });
        });

       $('#center_name').change(function(e)
       {
           e.preventDefault();
                var company_phone = $(this).find(':selected').data('phone');
                $('#center_phone').val(company_phone);
                // alert(com_ph);
       });

    });



</script>
@endsection