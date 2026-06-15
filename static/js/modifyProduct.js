let selectIdArtInfos = document.querySelector("#idArticleInformations")

selectIdArtInfos.addEventListener("change", () => {

    if (selectIdArtInfos.value > -1) {
        fetch("?path=/getArtInfos/" + selectIdArtInfos.value)
            .then(r => {
                if (r.ok) {
                    return r.json()
                } else {
                    throw new Exception("Une erreur est survenue, impossible de charger les filtres. Vérifiez votre connexion internet ou le statut de la base de données")
                }
            })
            .then(artInfos => {
                document.querySelector("#articleName").value = artInfos['article_name']
                document.querySelector("#idBrand").value = artInfos['id_brand']
                document.querySelector("#description").value = artInfos['description']
                document.querySelector("#price").value = artInfos['price']
            })
            .catch((e) => {
                console.log(e)
            })
    }
    else {
        document.querySelector("#articleName").value = ""
        document.querySelector("#idBrand").value = ""
        document.querySelector("#description").value = ""
        document.querySelector("#price").value = ""
    }

})