

<style>
    @media print {
	@page {
		margin-top: 0;
		margin-bottom: 0;
	}
	body {
        margin-left: 20px ;
		padding-top: 72px;
		padding-bottom: 72px ;
        padding-left: 25px ;
	}
    .titel {
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  margin-bottom: 15px ;
  font-size: 1.2rem;
}
.nom{
    font-weight: bold;
}
.space {
    display: flex;
    align-items:center;
}

.name {
   
    padding-right: 30px ;
}
.age {
    margin-left: 200px ;
}
.blas {
margin-left: 15px;
}
hr {
  border: 0.5px solid black;
}
.date{
    margin-left: 400px ;
}
}

</style>

<body>
    
    <div class="titel">LABORATOIRE DE CYTOLOGIE ET D'ANATOMIE PATHOLOGIQUE </div>
    <div class="nom">Dr GHERNAOUT-BOUABDALLAH Faiza</div>
    <div class="coordonee">Spécialiste en cytopathologie et en anatomie pathologique. <br>
         Cité des 325 Logements, Bt ATLEMCEN <br>

        Tel/Fax: 043 41 69 89 <br>
         E-mail: f_ghern@yahoo.fr</div>
        <br><br>
    
    <div class="space">
        <div class="name">
    nom :{{$patient->name }} </div>
    <div class="age">
    age :{{$patient->age }}<br> </div> </div>
  
   
    Référence : {{$patient->serie }} <br>
    <br>
    
    <div class="space">
    <div>Type de prélèvement:{{$patient->choices }} </div> <div class="blas">{{$patient->type }}</div>
    </div>
    <br>
    <hr> 
    <br><br>
    <div class="date">Tlemcen le: {{$date}} </div>
    <br><br><br><br>
    {{$patient->description }}
    </body>



<script>
    window.print() ;
setTimeout(() => {
    (window.location = "/Patients");
}, 2000); 
</script>