<div class="titlebar">
    <h1>About Me</h1>
    <button class="secondary">
       <h2> {{$formMode === 'edit' ? 'Save changes': ''}}</h2>
    </button>
</div>
@if(session('flash_message'))
    <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
        {{ session('flash_message') }}
    </div>
@endif
<div class="card-wrapper">
    <div class="wrapper_left">
        <div class="card">
            <label>Full Name</label>
            <label>
                <input type="text" name="name" value="{{isset($about->name) ? $about->name : ''}}"/>
                {!! $errors->first('name','<p class="alert">:message</p>') !!}
            </label>

            <label>Email</label>
            <label>
                <input type="email" name="email" value="{{isset($about->email) ? $about->email : ''}}" />
                {!! $errors->first('email','<p class="alert">:message</p>') !!}
            </label>

            <label>Location</label>
            <label>
                <input type="text"  name="location" value="{{isset($about->location) ? $about->location : ''}}" />
            </label>

            <label>Short Bio</label>
            <label>
                <textarea type="text" cols="10" rows="2" name="short_bio" >{{isset($about->short_bio) ? $about->short_bio : ''}}</textarea>
            </label>

            <label>Description</label>
            <label>
                <textarea type="text" cols="10" rows="3" name="description" >{{isset($about->description) ? $about->description : ''}}</textarea>
            </label>

        </div>
        <div class="card">
            <label>Tagline</label>
            <label>
                <input type="text" />
            </label>
        </div>

    </div>
    <div class="wrapper_right">
        <div class="card">
            <label>Home Image</label>
            <img src="{{isset($about->home_image) ? asset('images/'.$about->home_image) : asset('template/assets/img/avatar.jpg')}}"  alt class="avatar_img" id="homeImage-preview">
            <input accept="image/*" type="file" id="fileimg" name="home_image" onchange="showHomeImageFile(event)">
        </div>
        <div class="card">
            <label>About Image</label>
            <img src="{{isset($about->banner_image) ? asset('images/'.$about->banner_image) : asset('template/assets/img/avatar.jpg')}}" alt class="avatar_img" id="bannerImage-preview">
            <input accept="image/*" type="file" id="fileimg" name="banner_image" onchange="showBannerImageFile(event)">
        </div>
        <div class="card">
            <p>CV</p>
            <input accept="pdf/*" type="file" id="filecv" name="cv" value="{{isset($about->cv) ? $about->cv : ''}}">
        </div>
    </div>
</div>

<script>
    function showHomeImageFile(event){
        var input = event.target;
        var reader = new FileReader()
        reader.onload= function (){
            var dataURL = reader.result;
            var output = document.getElementById('homeImage-preview');
            output.src = dataURL;

        };
        reader.readAsDataURL(input.files[0]);
    }
    function showBannerImageFile(event){
        var input = event.target;
        var reader = new FileReader()
        reader.onload= function (){
            var dataURL = reader.result;
            var output = document.getElementById('bannerImage-preview');
            output.src = dataURL;

        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
