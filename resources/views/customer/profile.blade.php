@extends('customer.layouts.app')
@section('content')
<form class="form" action="{{ route('profile.update') }}" method="post" id="registrationForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <input type="hidden" name="province_name" id="province_name">
    <input type="hidden" name="city_name" id="city_name">
    <div class="form-group p-3 mb-5">                          
        <div class="col-xs-6">
            <label for="first_name">Name</label>
            <input type="text" required class="form-control" value="{{ $user->name }}" name="name" placeholder="first name" title="enter your name">
        </div>                         
        <div class="col-xs-6">
            <label for="first_name">Email</label>
            <input type="text" required class="form-control" value="{{ $user->email }}" name="email" placeholder="first name" title="enter your email">
        </div>
    </div>
    <div class="form-group p-3 mb-5">                          
        <div class="col-xs-6">
            <label for="first_name">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" title="enter your first name if any.">
        </div>                         
        <div class="col-xs-6">
            <label for="first_name">Photo</label>
            <input type="file" name="photo" id="photoInput">
        </div>
    </div>    
    <div class="form-group p-3 mb-5">                
        <div class="col-xs-6">
            <label for="first_name">Province</label>
            <select name="province" class="form-control" id="provinceInput">
                <option>-- Select Province --</option>
            </select>
        </div>                         
        <div class="col-xs-6">
            <label for="first_name">City</label>
            <select name="city" class="form-control" id="cityInput">
                <option>-- Select City --</option>
            </select>
        </div>
    </div>    
    <div class="form-group p-3 mb-5">                          
        <div class="col-xs-6">
            <label for="first_name">Phone</label>
            <input type="text" required class="form-control" value="{{ $user->details && $user->details->phone ? $user->details->phone : '' }}" name="phone" placeholder="Phone" title="enter your Phone">
        </div>                         
        <div class="col-xs-6">
            <label for="first_name">Postal Code</label>
            <input type="text" required class="form-control" value="{{ $user->details && $user->details->postal_code ? $user->details->postal_code : '' }}" id="postal_code" name="postal_code" placeholder="Postal Code" title="enter your Postal Code">
        </div>
    </div>
    <div class="form-group p-3 mb-5">                          
        <div class="col-xs-6">
            <label for="first_name">Gender</label>
            <select name="gender" class="form-control" id="">
                <option value="man" <?= $user->details && ($user->details->gender == 'man' ? 'selected' : '' )?>>Man</option>
                <option value="women" <?= $user->details && ($user->details->gender == 'women' ? 'selected' : '' )?>>Women</option>
            </select>
        </div>                      
        <div class="col-xs-6">
            <label for="first_name">Detail Address</label>
            <textarea required name="detail_address" class="form-control" id="" cols="30" rows="10">{{ $user->details && $user->details->detail_address ? $user->details->detail_address : '' }}</textarea>
        </div>   
    </div>
    <div class="form-group p-3 mb-5 pb-5">
        <div class="col-xs-12">
                <br>
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                <button class="btn" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        let provinceInput = document.querySelector('select[name="province"]');
        let citiesInput = document.querySelector('select[name="city"]');
        let postalCodeArr = [];
        $('#provinceInput').on('change', (e)=> {
            $.ajax({
                url: '/get-city-by-province/' + e.target.value,
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#province_name').val(e.target.options[e.target.selectedIndex].innerHTML);
                    console.log(response)
                    citiesInput.innerHTML = '';
                    response.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.city_id;
                        option.textContent = city.city_name;
                        option.selected = '<?= $user->details->city_code ?>' === city.city_id ? true : false;
                        citiesInput.appendChild(option);
                        postalCodeArr.push({[city.city_id] : city.postal_code});
                    });
                    console.log(postalCodeArr)
                    
                },
                error: function(response) {
                    console.log(response);
                    alert('Error fetch cities data');
                }
            })
        });
        $.ajax({
            url: '/get-province',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Handle successful response
                console.log(response);
                response.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.province_id;
                    option.textContent = province.province;
                    option.selected = '<?= $user->details->province_code ?>' === province.province_id ? true : false;
                    provinceInput.appendChild(option);
                });
                $('#provinceInput').trigger('change');                    
            },
            error: function(response) {
                // Handle error response
                console.log(response);
                alert('Error adding province');
            }
        });
        
        $('#cityInput').on('change', (e)=>{
            $('#city_name').val(e.target.options[e.target.selectedIndex].innerHTML);
            let selectedCityId = e.target.value;
            let pcode = postalCodeArr.find(city => city.hasOwnProperty(selectedCityId));
            console.log(pcode[selectedCityId], "selected pcode")
            console.log(selectedCityId, "selected id")
            $('#postal_code').val(pcode[selectedCityId]);
        })
    });
    $('#photoInput').on('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('photoPreview');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection