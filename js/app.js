window.sr = ScrollReveal({ reset: true });
sr.reveal('.btnAnimate', { duration: 900 });
sr.reveal('.titreAnimate', { duration: 900 });
sr.reveal('.imgAnimate', {origin: 'right', distance: '300px', duration: 2000});


function active_onglet(identifiant)
{
    $("#inscriptions").removeClass( "active" );
    $("#utilisateurs").removeClass( "active" );
    $("#liste_attente").removeClass( "active" );
    $("#historique").removeClass( "active" );
    $("#INSCRIPTIONS").removeClass( "active" );
    $("#UTILISATEURS").removeClass( "active" );
    $("#LISTE_ATTENTE").removeClass( "active" );
    $("#HISTORIQUE").removeClass( "active" );
    $("#INSCRIPTIONS").removeClass( "in" );
    $("#UTILISATEURS").removeClass( "in" );
    $("#LISTE_ATTENTE").removeClass( "in" );
    $("#HISTORIQUE").removeClass( "in" );
    $("#" + identifiant).addClass( "active" );
    $("#" + identifiant.toUpperCase()).addClass( "active" );
    $("#" + identifiant.toUpperCase()).addClass( "in" );
}

function active_onglet_user(identifiant)
{
    $("#place").removeClass( "active" );
    $("#historique_user").removeClass( "active" );
    $("#parametres").removeClass( "active" );
    $("#PLACE").removeClass( "active" );
    $("#HISTORIQUE_USER").removeClass( "active" );
    $("#PARAMETRES").removeClass( "active" );
    $("#PLACE").removeClass( "in" );
    $("#HISTORIQUE_USER").removeClass( "in" );
    $("#PARAMETRES").removeClass( "in" );
    $("#" + identifiant).addClass( "active" );
    $("#" + identifiant.toUpperCase()).addClass( "active" );
    $("#" + identifiant.toUpperCase()).addClass( "in" );
}

//window.sr = ScrollReveal();
//sr.reveal('.foo');
//sr.reveal('.bar');