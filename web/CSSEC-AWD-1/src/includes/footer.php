<footer>
    <small>&copy; 2024 <a href="https://www.yuque.com/cssec/wiki" target="_blank">CSSEC</a></small>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let articleCount = 5; // 已加载的文章数量
            let moreArticlesButton = document.getElementById('more-articles');

            moreArticlesButton.addEventListener('click', function () {
                fetch('/index.php?count=' + articleCount + '&async=1')
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            moreArticlesButton.disabled = true;
                            moreArticlesButton.innerText = data.message;
                        } else {
                            for (let i = 0; i < data.length; i++) {
                                let article = data[i];
                                let articleItem = document.createElement('li');
                                articleItem.className = 'article-item';
                                articleItem.innerHTML =
                                    "<h3 class='article-title'>" + article.title + "</h3>" +
                                    "<p class='article-content-outline'>" + article.content + "</p>" +
                                    "<small class='article-meta'>" +
                                    "<span class='article-time'>" + article.created_at + "</span>" +
                                    "<a href='article.php?id=" + article.id + "' class='article-read-all'>阅读全文 >>></a>" +
                                    "</small>";
                                document.querySelector('.article-list').appendChild(articleItem);
                            }
                            articleCount += data.length;
                        }
                    });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</footer>