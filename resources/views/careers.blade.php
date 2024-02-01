<x-layout>
    <x-header title="Lavora con noi" />
    
    <div class="container my-5 FormColor border border-dark rounded">
        <div class="row justify-content-center align-items-center border rounded p-2 shadow">
            <div class="col-11   ">
                <h2 class="text-center mt-4">Lavora come amministratore</h2>
                <p>Cosa farai: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, voluptates error. Harum, necessitatibus! Aliquam, pariatur iste. Veritatis perferendis odit beatae explicabo minus, eligendi impedit modi.</p>
                <hr class=" my-4 ">
                <h2 class="text-center" >Lavora come revisore</h2>
                <p>Cosa farai: Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, illum! Veniam sunt laboriosam iusto accusantium esse eveniet, voluptates molestiae magni? Minima alias veniam quia doloremque!</p>
                <hr class=" my-4 ">
                <h2 class="text-center">Lavora come scrittore</h2>
                <p>Cosa farai: Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto eos quod laboriosam natus labore ratione? Deserunt minima libero iste est consectetur rerum doloremque quae blanditiis?</p>
                <hr class=" my-4 ">
            </div>
            <div class="col-12 col-md-6">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>                            
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            
            
            
            <form class="p-5   " action="{{route('careersSubmit')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="role" class="  form-label">Per quale ruolo ti stai candidando?</label>
                    <select name="role" id="role" class=" FormInputColor form-control">
                        <option value="">Scegli qui</option>
                        <option value="admin">Amministratore</option>
                        <option value="revisor">Revisore</option>
                        <option value="writer">Scrittore</option>
                    </select>
                </div>
                <div class="mb-3 ">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class=" FormInputColor form-control" id="email" value="{{old('email') ?? Auth::user()->email}}">
                </div>

                <div class="mb-3 ">
                    <label for="message" class="form-label">Parlaci di te</label>
                    <textarea name="message" id="message" class=" FormInputColor form-control" cols="30" rows="10">{{old('message')}}</textarea>
                </div>
               
                <button class="btn btn-outline-dark">Invia la tua candidature</button>
            </form>
        </div>
    </div>
    
    
    
</x-layout>