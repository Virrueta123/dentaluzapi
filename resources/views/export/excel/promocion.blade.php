 
 <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
  @php
  use App\Models\promocion_mensualidad;
  $styleBoder = "border: 2px solid black;";
  @endphp
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <tbody>
          <tr class="row1" style="background:#37BC4A; color:white; {{$styleBoder}}">
            <td  style="background:#37BC4A; color:white; text-align: center; {{$styleBoder}}" colspan="13">CUOTAS DE LA PROMOCIÓN</td>
           
          </tr>
          
          <tr class="row2">
        
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

          @foreach ($alumnos as $al)
    
          @php 
          $aportaciones = promocion_mensualidad::where("Al_Id",$al["Al_Id"])->get();
          $suma = promocion_mensualidad::where("Al_Id",$al["Al_Id"])->sum("Prm_Monto");
          @endphp
      
            <tr> 
              <td style="{{ $styleBoder }}">{{ $al["Al_Nombre"] }} - {{ $al["Al_Apellido"] }}</td> 
              @foreach ($aportaciones as $ap)
                <td style="{{ $styleBoder }}">{{ $ap["Prm_Monto"] }}</td>
              @endforeach 

              <td style="{{ $styleBoder }}">
                {{ 1400 }}
              </td>

              <td style="{{ $styleBoder }}">
                {{ $suma }}
              </td>

              <td style="{{ $styleBoder }}">
                {{ 1400 - $suma }}
              </td>
            </tr>
      
          @endforeach
           
          <tr class="row28">
            <td class="column0">&nbsp;</td>
            <td class="column1">&nbsp;</td>
            <td class="column2">&nbsp;</td>
            <td class="column3">&nbsp;</td>
            <td class="column4">&nbsp;</td>
            <td class="column5">&nbsp;</td>
            <td class="column6">&nbsp;</td>
            <td class="column7">&nbsp;</td>
            <td class="column8">&nbsp;</td>
            <td class="column9">&nbsp;</td>
            <td class="column10">&nbsp;</td>
            <td class="column11">&nbsp;</td>
            <td class="column12">&nbsp;</td>
            <td class="column13">&nbsp;</td>
            <td class="column14">&nbsp;</td>
            <td class="column15">&nbsp;</td>
          </tr>

          <tr class="row1" style="background:#37BC4A; color:white; {{$styleBoder}}">
            <td  style="background:#d51825; color:white; text-align: center; {{$styleBoder}}" colspan="2">Gastos</td> 
          </tr> 

            @foreach ($egresos as $eg)
            <tr class="row1" > 
                <td  style="{{$styleBoder}}" >{{$eg["Hxp_Descripcion"]}}</td> 
                <td  style="{{$styleBoder}}" >{{$eg["Hxp_Monto"]}}</td> 
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
            
 
        </tbody>
    </table>
 