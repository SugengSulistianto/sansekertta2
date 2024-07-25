@extends('admin.layout.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Store Info </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('storeinfoupdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="province_name" id="province_name">
                            <input type="hidden" name="city_name" id="city_name">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Store Name</label>
                                    <input type="text" name="name" value="{{ $storeinfo->name }}" class="form-control" placeholder="Store Name ...." required>
                                </div>
                                <div class="form-group">
                                    <label>Store Phone</label>
                                    <input type="text" name="phone" value="{{ $storeinfo->phone }}" class="form-control" placeholder="Store Phone ...." required>
                                </div>
                                <div class="form-group">
                                    <label>Province</label>
                                    <select name="province" class="form-control" id="provinceInput">
                                        <option>-- Select Province --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city" class="form-control" id="cityInput">
                                        <option>-- Select City --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Store Email</label>
                                    <input type="text" name="email" value="{{ $storeinfo->email }}" class="form-control" placeholder="Store Email ...." required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" id="" cols="30" rows="10">{{ $storeinfo->address }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                            option.selected = '<?= $storeinfo->city_code ?>' === city.city_id ? true : false;
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
                        option.selected = '<?= $storeinfo->province_code ?>' === province.province_id ? true : false;
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
@endsection
