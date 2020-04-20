    @foreach($data as $row)
      <tr>
       <td>{{ $row->name}}</td>
       <td>{{ $row->email }}</td>
      
      </tr>
      @endforeach
      <tr>
       <td colspan="3" align="center">
        {!! $data->links() !!}
       </td>
      </tr>
