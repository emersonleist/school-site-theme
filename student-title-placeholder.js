wp.domReady(() => {
    wp.data.subscribe(() => {
        const postType = wp.data.select('core/editor').getCurrentPostType();
        if (postType === 'students') {
            const titleField = document.querySelector('.editor-post-title__input');
            if (titleField && titleField.placeholder !== 'Add student name') {
                titleField.placeholder = 'Add student name';
            }
        }
    });
});

