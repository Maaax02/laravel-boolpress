<form action="{{ route('admin.posts.index', $post->id) }}" method="POST" class="d-inline-block">
    @csrf
    @method("delete")
  
    <button type="submit" class="btn btn-link text-danger">
      <i class="fa-regular fa-trash-can"></i>
    </button>
  </form>