<div class="game">
    <?php if (isset($imageUrl)): ?>
        <img src="/<?= $imageUrl ?>">
    <?php endif; ?>
    <h2><?= $jeu->getTitle() ?></h2>
    <h7><?= $categorie->getCategoryName() ?></h7>
    <?php if (isset($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="mt-5 border p-2" style="min-width: 50vw">
                <h5><a href='/articles/article?id=<?= $article->getId() ?>'
                       style="text-decoration: none; color: black;"><?= $article->getTitle() ?></a></h5>
                <p><?= $article->getContent() ?></p>
                <?php foreach ($commentsByArticles as $commentsByArticle): ?>
                    <?php if ($commentsByArticle["articleId"] == $article->getId() && !is_null($commentsByArticle["articleId"])): ?>
                        <div class="toggle-table-btn" onclick="toggleTable(this)" style="cursor: pointer">Afficher les
                            commentaires
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach ($commentsByArticles as $commentsByArticle): ?>
                    <table class="table table-responsive table-borderless" style="display: none;">
                        <thead>
                        <tr class="bg-light border-1">
                            <th scope="col" width="10%">Date</th>
                            <th scope="col" width="33%">Commentaire</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($commentsByArticle["articleId"] == $article->getId()): ?>
                            <?php foreach ($commentsByArticle["comments"] as $comment): ?>
                                <tr>
                                    <td><?= $comment->getCreationDate(); ?></td>
                                    <td><?= $comment->getContent(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    function toggleTable(btn) {
        var table = btn.nextElementSibling;
        if (table.style.display === "none") {
            table.style.display = "table";
            btn.textContent = "Masquer les commentaires";
        } else {
            table.style.display = "none";
            btn.textContent = "Afficher les commentaires";
        }
    }
</script>
