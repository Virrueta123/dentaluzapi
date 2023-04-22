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
    @foreach ($alumnos as $al)
    
    @php 
    $aportaciones = ingresosAportaciones::where("Al_Id",$al["Al_Id"])->get();
    $suma = ingresosAportaciones::where("Al_Id",$al["Al_Id"])->sum("Ipo_Monto");
    @endphp

      <tr> 
        <td style="{{ $styleBoder }}">{{ $al["Al_Nombre"] }} - {{ $al["Al_Apellido"] }}</td> 
        @foreach ($aportaciones as $ap)
          <td style="{{ $styleBoder }}">{{ $ap["Ipo_Monto"] }}</td>
        @endforeach 
        <td style="{{ $styleBoder }}">
          {{ 200 - $suma }}
        </td>
      </tr>

    @endforeach 

    <tr>
      <td> 
      </td>
    </tr>

    <tr>
      <td> 
      </td>
    </tr>

    <tr>
      <td colspan="2" style="background:#E34032; color:white; text-align: center; {{ $styleBoder }}" >
        Todo los gastos
      </td>
    </tr>

    @foreach ( $egresos as $eg )

      <tr>
        <td style="{{ $styleBoder }}">
          {{ $eg["Iah_Descripcion"] }}
        </td>
        <td style="{{ $styleBoder }}">
          {{ $eg["Iah_Monto"] }}
        </td>
      </tr>

    @endforeach
 
    <tr>
      <td> 
      </td>
    </tr>
    
    <tr>
      <td style="{{ $styleBoder }}">
        Total de ingresos que aportaron
      </td>
      <td style="{{ $styleBoder }}">
         {{ $ingresosTotal }}
      </td>
    </tr> 

    <tr>
      <td style="{{ $styleBoder }}">
        Gastos totales
      </td>
      <td style="{{ $styleBoder }}">
         {{ $egresosTotal }}
      </td>
    </tr>

    <tr>
      <td style="{{ $styleBoder }}">
        Total sobrante
      </td>
      <td style="{{ $styleBoder }}">
         {{ $ingresosTotal - $egresosTotal }}
      </td>
    </tr>

    <tr>
      <td> 
      </td>
    </tr>

    <tr>
      <td style="{{ $styleBoder }}">
        Total de las aportaciones
      </td>
      <td style="{{ $styleBoder }}">
         {{ $total_aporte * count($alumnos) }}
      </td>
    </tr>

    <tr>
      <td style="{{ $styleBoder }}">
        Total de aportaciones que falta abonar
      </td>
      <td style="{{ $styleBoder }}">
         {{ $total_aporte * count($alumnos) - $ingresosTotal }}
      </td>
    </tr>

</table>