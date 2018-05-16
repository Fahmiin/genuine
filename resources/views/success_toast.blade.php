@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'postSuccess')
    <script>
        M.toast({html: 'Post successfully created!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'postCommentSuccess')
    <script>
        M.toast({html: 'Comment successfully posted!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'deleteSuccess')
    <script>
        M.toast({html: 'Post successfully removed!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'deleteCommentSuccess')
    <script>
        M.toast({html: 'Comment successfully removed!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'updateSuccess')
    <script>
        M.toast({html: 'Profile updated!'})
    </script>
@endif