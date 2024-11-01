jQuery(document).ready(function($){

    var facebook_mediaUploader;
    $('#upload_facebook_link').click(function(e) {
        e.preventDefault();
        if (facebook_mediaUploader) {
            facebook_mediaUploader.open();
            return;
        }
        facebook_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        facebook_mediaUploader.on('select', function() {
            var attachment = facebook_mediaUploader.state().get('selection').first().toJSON();
            $('#facebook_image').val(attachment.url);
        });
        facebook_mediaUploader.open();
    });

    var tumblr_mediaUploader;
    $('#upload_tumblr_link').click(function(e) {
        e.preventDefault();
        if (tumblr_mediaUploader) {
            tumblr_mediaUploader.open();
            return;
        }
        tumblr_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        tumblr_mediaUploader.on('select', function() {
            var attachment = tumblr_mediaUploader.state().get('selection').first().toJSON();
            $('#tumblr_image').val(attachment.url);
        });
        tumblr_mediaUploader.open();
    });

    var instagram_mediaUploader;
    $('#upload_instagram_link').click(function(e) {
        e.preventDefault();
        if (instagram_mediaUploader) {
            instagram_mediaUploader.open();
            return;
        }
        instagram_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        instagram_mediaUploader.on('select', function() {
            var attachment = instagram_mediaUploader.state().get('selection').first().toJSON();
            $('#instagram_image').val(attachment.url);
        });
        instagram_mediaUploader.open();
    });

    var twitter_mediaUploader;
    $('#upload_twitter_link').click(function(e) {
        e.preventDefault();
        if (twitter_mediaUploader) {
            twitter_mediaUploader.open();
            return;
        }
        twitter_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        twitter_mediaUploader.on('select', function() {
            var attachment = twitter_mediaUploader.state().get('selection').first().toJSON();
            $('#twitter_image').val(attachment.url);
        });
        twitter_mediaUploader.open();
    });

    var line_mediaUploader;
    $('#upload_line_link').click(function(e) {
        e.preventDefault();
        if (line_mediaUploader) {
            line_mediaUploader.open();
            return;
        }
        line_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        line_mediaUploader.on('select', function() {
            var attachment = line_mediaUploader.state().get('selection').first().toJSON();
            $('#line_image').val(attachment.url);
        });
        line_mediaUploader.open();
    });

    var linkedin_mediaUploader;
    $('#upload_linkedin_link').click(function(e) {
        e.preventDefault();
        if (linkedin_mediaUploader) {
            linkedin_mediaUploader.open();
            return;
        }
        linkedin_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        linkedin_mediaUploader.on('select', function() {
            var attachment = linkedin_mediaUploader.state().get('selection').first().toJSON();
            $('#linkedin_image').val(attachment.url);
        });
        linkedin_mediaUploader.open();
    });

    var youtube_mediaUploader;
    $('#upload_youtube_link').click(function(e) {
        e.preventDefault();
        if (youtube_mediaUploader) {
            youtube_mediaUploader.open();
            return;
        }
        youtube_mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false 
        });
        youtube_mediaUploader.on('select', function() {
            var attachment = youtube_mediaUploader.state().get('selection').first().toJSON();
            $('#youtube_image').val(attachment.url);
        });
        youtube_mediaUploader.open();
    });
});
