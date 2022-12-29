<!DOCTYPE html>
<!-- CSS only -->
<html>
<head>
  <meta name="csrf-token" content="{{csrf_token()}}">
</head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('Patients.index') }}">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('Patients.index') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{route('Patients.biopsie') }}">Biopsie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{route('Patients.cyto') }}">Cyto</a>
              </li>
              <li class="nav-item dropdown link-warning">
                <a class="nav-link dropdown-toggle link-warning" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  deconnecter
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                 
                  <li><hr class="dropdown-divider"></li>
                  <li>
                  
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left"></i>
                        <span class="titre text-danger"><b>déconnecter</b></span>
                      </a>
            
            
            
            
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                        </span>
                      </a>
                    </li>
                  
                  </li>
                </ul>
              </li>

            </ul>



            <form class="d-flex" action="{{ route('Patients.search') }}" method="POST" id="search-form">
              <input class="form-control me-2" type="search" placeholder="nom prenom" aria-label="Search" name="q" id="q">
              <button class="btn btn-outline-success" type="submit">Recherche</button>
            </form>


          </div>
        </div>
      </nav>

<div class="container">
  @if(Session::has('info'))
    <div class="alert alert-danger">
      {{Session::get('info')}}
    </div>
    @endif

    @if ($message = Session::has('editer'))

    <div class="alert alert-success mt-4 ">
    
      
           {{Session::get('editer')}}
    
    </div>
    
    @endif
<div class="py-12">
  <h1>liste des Patients</h1>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div id="aaaa">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    @can('destroye-edit')
                    <th scope="col">paye</th>
                    @endcan
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                    <th scope="col">tel</th>
                    <th scope="col">type</th>
                    <th scope="col">actions</th>
                  </tr>
                </thead>
               
                <tbody> 
                 
            
                @foreach ($patients as $patient)
                    <tr>
                      @can('destroye-edit')
                      <td>
                        @if ($patient->fini == 1)
                        <img src="{{ asset('v.png') }}" alt="description of myimage" width="30" height="30">
                        @else
                        <img src="{{ asset('X.png') }}" alt="description of myimage" width="30" height="30"> 
                        @endif
                        

                      </td>
                      @endcan

                        <td>{{$patient->serie}}</td>
                      <td>{{$patient->name}}</td>
                    
                   

                      <td>  {{$number=substr($patient->num, -10, -6) . "-" .
                        substr($patient->num, -6, -4) . "-" .
                        substr($patient->num, -4, -2) . "-" .
                        substr($patient->num, -2);}} </td>
                      <td>  {{$patient->choices}} </td>
                       
                      <td>
                        <a href="{{route('Patients.show' , $patient->id) }}" class="btn btn-info m-1">Details</a>
                         
                        <a href="{{route('Patients.edit' , $patient->id) }}" > <button class="btn btn-primary"> editer</button></a>
                     
                     
                       
                          <button type="submit" class="btn btn-warning ">suprimer</button>
                        
                     

                             </td>
                    </tr>
                @endforeach
                    

                    </tbody>  
                 
               </table> 

    </div>
</div>
</div>


</div>
<!-- JavaScript Bundle with Popper -->

<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
