<x-mail::message>
# New Post Published

A new post has been published on the website you're subscribed to.

## Post Title
{{ $post->title }}

## Post Description
{{ $post->description }}

<x-mail::button :url="$post->url">
    Read More
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
