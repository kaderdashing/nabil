

<style>
    @media print {
	@page {
		margin-top: 0;
		margin-bottom: 0;
	}
	body {
		padding-top: 72px;
		padding-bottom: 72px ;
	}
}

</style>

<body>
    {{$patient->id }}
    {{$patient->name }}
    {{$patient->age }}
    {{$patient->type }}
    {{$patient->num }}
    {{$patient->serie }} 
    <br>
    {{$patient->description }} 
    
    {{$patient->choices }}
    
    </body>





<script>
    window.print()
    //window.location="https://stackoverflow.com" ;
    setTimeout(() => {  (window.location="/Patients") ; }, 2000);
</script>