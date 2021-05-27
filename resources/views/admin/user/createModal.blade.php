<!-- The Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
                <h4 class="modal-title">Yenı kullanıcı oluştur!</h4>

                <button type="button" data-bs-dismiss="modal" class="close text-white">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label>Yetki</label>
                    <select class="form-control" name="role" required>
                        <option value="" selected>Seç</option>
                        @if(Auth::user()->role == 'root')
                        <option value="root" >Root</option>
                        @endif
                        <option value="admin" >Admin</option>
                        <option value="user" >User</option>
                    </select>
                    
                    </div>
                    @if(Auth::user()->role == 'root')
                    <div class="form-group">
                        <label>Company</label>
                        <select class="form-control" name="company_id" required>
                            <option value="" selected>Seç</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label>Kullanıcı Tam adı</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input  class="form-control" type="text" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Parola</label>
                        <input id="password" class="form-control" type="password" name="password" required>
                        <input type="checkbox" name="show" id="showPassword"> Parolayı göster
                    </div>
                    <div class="form-group">
                        <label>Resim</label><br>
                        <input type="file" name="image" >
                    </div>
                    <button type="submit" class="btn btn-success" >Kaydet</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Iptal</button>
                </form>
            </div>
        </div>
    </div>
</div>

