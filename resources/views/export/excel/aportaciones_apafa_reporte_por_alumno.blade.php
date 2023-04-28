<table border="1">
    @php
    use App\Models\ingresosAportaciones;
    $styleBoder = "border: 2px solid black;";
    @endphp
      <tr >
        <td colspan="12" style="background:#23A8F2; color:white; text-align: center; {{ $styleBoder }}">
        Aportaciones del año 2023
      </td>
      </tr>
      <tr>
        <th style="{{ $styleBoder }}">Alumnos</th>
        <th style="{{ $styleBoder }}">Marzo</th>
        <th style="{{ $styleBoder }}">Abril</th>
        <th style="{{ $styleBoder }}">Mayo</th>
        <th style="{{ $styleBoder }}">Junio</th>
        <th style="{{ $styleBoder }}">Julio</th>
        <th style="{{ $styleBoder }}">Agosto</th>
        <th style="{{ $styleBoder }}">Setiembre</th>
        <th style="{{ $styleBoder }}">Octubre</th>
        <th style="{{ $styleBoder }}">Noviembre</th>
        <th style="{{ $styleBoder }}">Diciembre</th> 
        <th style="{{ $styleBoder }}">Falta abonar</th> 
      </tr>
   
  
        <tr> 
          <td style="{{ $styleBoder }}">{{ $alumnos["Al_Nombre"] }} - {{ $alumnos["Al_Apellido"] }}</td> 
          @foreach ($aportaciones as $ap)
            <td style="{{ $styleBoder }}">{{ $ap["Ipo_Monto"] }}</td>
          @endforeach 
          <td style="{{ $styleBoder }}">
            {{ 200 - $sum }}
          </td>
        </tr>
  
    
  
    
  
  </table>