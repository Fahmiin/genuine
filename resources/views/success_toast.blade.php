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

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'tagCreateSuccess')
    <script>
        M.toast({html: 'New tag created!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'editSuccess')
    <script>
        M.toast({html: 'Post edited successfully!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'reviewSuccess')
    <script>
        M.toast({html: 'Review successfully posted!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'deleteReviewSuccess')
    <script>
        M.toast({html: 'Review successfully removed!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'replySuccess')
    <script>
        M.toast({html: 'Reply successfully posted!'})
    </script>
@endif

@if(!empty(Session::get('session_code')) && Session::get('session_code') == 'deleteReplySuccess')
    <script>
        M.toast({html: 'Reply successfully removed!'})
    </script>
@endif