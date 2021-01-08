@include('layouts.header')
<style>
    /* Base for label styling */
    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked {
      position: absolute;
      left: -9999px;
    }
    [type="checkbox"]:not(:checked) + label,
    [type="checkbox"]:checked + label {
      position: relative;
      padding-left: 1.95em;
      cursor: pointer;
    }
    
    /* checkbox aspect */
    [type="checkbox"]:not(:checked) + label:before,
    [type="checkbox"]:checked + label:before {
      content: '';
      position: absolute;
      left: 0; top: 0;
      width: 1.50em; height: 1.50em;
      border: 2px solid #ccc;
      background: #fff;
      border-radius: 4px;
      box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
    }
    /* checked mark aspect */
    [type="checkbox"]:not(:checked) + label:after,
    [type="checkbox"]:checked + label:after {
      content: '\2713\0020';
      position: absolute;
      top: .15em; left: .22em;
      font-size: 1.3em;
      line-height: 0.8;
      color: #0042f8;
      transition: all .2s;
      font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
    }
    /* checked mark aspect changes */
    [type="checkbox"]:not(:checked) + label:after {
      opacity: 0;
      transform: scale(0);
    }
    [type="checkbox"]:checked + label:after {
      opacity: 1;
      transform: scale(1);
    }
    /* disabled checkbox */
    [type="checkbox"]:disabled:not(:checked) + label:before,
    [type="checkbox"]:disabled:checked + label:before {
      box-shadow: none;
      border-color: #bbb;
      background-color: #ddd;
    }
    [type="checkbox"]:disabled:checked + label:after {
      color: #999;
    }
    [type="checkbox"]:disabled + label {
      color: #aaa;
    }
    /* accessibility */
    [type="checkbox"]:checked:focus + label:before,
    [type="checkbox"]:not(:checked):focus + label:before {
      border: 2px dotted #5464da;
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Akun Supplier</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('menu-user') }}">Management Akun Supplier</a></div>
                <div class="breadcrumb-item active">Edit Akun Supplier</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Data Supplier</h2>
            <p class="section-lead">Edit data akun supplier</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="card input_user">
                        <div class="card-body">
                            <div class="card-body">
                                <form method="POST" action="{{ route("update_data_user") }}">
                                    {{ csrf_field() }}
                                    <input id="id" value="{{ $id }}" name="id" hidden>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Vendor</label>
                                                <select id="company" name="vendor_name" class="form-control select2" required autofocus oninvalid="this.setCustomValidity('Nama Vendor Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                                    <option value="{{ $vendor_name }}">{{ $vendor_name }}</option>
                                                    @foreach($data_vendor as $v)
                                                        <option value="{{ $v->Vendor_Name }}" data-id="{{ $v->SysId }}" data-name="{{ $v->Vendor_Code }}">{{ $v->Vendor_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Vendor ID</label>
                                            <input value="{{ $vendor_id }}" type="text" class="form-control" id="vendor_id" name="vendor_id" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Vendor Code</label>
                                                <input value="{{ $vendor_code }}" type="text" class="form-control" id="vendor_code" name="vendor_code" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Username</label>
                                                <input value="{{ $username }}" type="text" class="form-control" name="username" tabindex="1" required autofocus oninvalid="this.setCustomValidity('Username Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Password</label>
                                                <input value="{{ $password }}" type="text" class="form-control" name="password" tabindex="1" required autofocus oninvalid="this.setCustomValidity('Password Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">E-Mail</label>
                                                <input value="{{ $email }}" type="text" class="form-control" name="email" tabindex="1" required autofocus oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Hak Akses</label>
                                                @if ($rr == 1)
                                                <p>
                                                    <input type="checkbox" name="rr" id="rr" value="1" checked/>
                                                    <label for="rr">Receiving Report</label>
                                                </p>
                                                @else
                                                <p>
                                                    <input type="checkbox" name="rr" id="rr" value="0"/>
                                                    <label for="rr">Receiving Report</label>
                                                </p>
                                                @endif
                                                @if ($coi == 1)
                                                <p>
                                                    <input type="checkbox" name="coi" id="coi" value="1" checked/>
                                                    <label for="coi">Certificate Of Invoice</label>
                                                </p>
                                                @else
                                                <p>
                                                    <input type="checkbox" name="coi" id="coi" value="0"/>
                                                    <label for="coi">Certificate Of Invoice</label>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Akses</label>
                                                <select name="jabatan" class="form-control select2" required>
                                                    <option value="">-- Select Jabatan --</option>
                                                    <option value="admin">Purchasing (Internal DWA)</option>
                                                    <option value="user">Supplier</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">SAVE</button>
                                                <a href="{{ route('menu-user') }}" class="btn btn-danger">CANCEL</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>   
    </section>
</div>
@include('layouts.footer')
<script>
    $(document).ready(function() {
        $('#company').change(function() {
            var company = $('#company option:selected').attr('data-id');
            var company2 = $('#company option:selected').attr('data-name');
            $('#vendor_id').val(company);
            $('#vendor_code').val(company2);
        });
    });
</script>