

<table id="example" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
    <th>User Name</th>
    <th>Organization Name</th>
    <th>Description</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($organizationData as $data)
    <tr>
        <td>{{$data->user->name}} </td>

        <td>{{$data->organizationName}}</td>
        <td>{{$data->description}} </td>
        <td>

            <a class="btn btn-success" href="{{ route('edit-organization', $data->id) }}">Edit</a>

            <form action="{{action('OrganizationController@delete', $data->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>


    </tr>
@endforeach

</tbody>
</table>

