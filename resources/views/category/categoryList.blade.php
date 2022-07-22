<div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Owner</th>
                        <th>Controls</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-outline-warning">
                                   <i class="feather-edit"></i> 
                                </a>
                                <form class="d-inline-block" action="{{ route('category.destroy',$category->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger">
                                        <i class="feather-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <span>{{ $category->created_at->format('d M Y') }}</span>
                                <br>
                                <span>{{ $category->created_at->format('h : i A') }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $categories->links() }}
</div>