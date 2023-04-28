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
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Alumnos</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Marzo</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Abril</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Mayo</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Junio</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Julio</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Agosto</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Setiembre</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Octubre</th>
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Noviembre</th> 
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Monto a pagar</th> 
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Monto abonado</th> 
        <th style="background:#37BC4A; color:white; text-align: center; {{ $styleBoder }}">Falta cancelar</th> 
      </tr>
   
  
        <tr> 
          <td style="{{ $styleBoder }}">{{ $alumnos["Al_Nombre"] }} - {{ $alumnos["Al_Apellido"] }}</td> 
          @foreach ($aportaciones as $ap)
            <td style="{{ $styleBoder }}">{{ $ap["Prm_Monto"] }}</td>
          @endforeach 

          <td style="{{ $styleBoder }}">
            {{ 1400 }}
          </td>

          <td style="{{ $styleBoder }}">
            {{ $sum }}
          </td>

          <td style="{{ $styleBoder }}">
            {{ 1400 - $sum }}
          </td>
           
        </tr>
  
    
  
    
  
  </table>