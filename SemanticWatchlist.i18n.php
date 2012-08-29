<?php

/**
 * Internationalization file for the Semantic Watchlist extension.
 *
 * @since 0.1
 *
 * @file SemanticWatchlist.i18n.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

$messages = array();

/** English
 * @author Jeroen De Dauw
 */
$messages['en'] = array(
	'semanticwatchlist-desc' => 'Lets users be notified of specific changes to Semantic MediaWiki data',

	'right-semanticwatch' => 'Use semantic watchlist',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Modify]] the semantic watchlist groups',

	'special-semanticwatchlist' => 'Semantic Watchlist',
	'special-watchlistconditions' => 'Semantic watchlist conditions',

	'group-swladmins' => 'Semantic Watchlist administrators',
	'group-swladmins-member' => '{{GENDER:$1|Semantic Watchlist administrator}}',
	'grouppage-swladmins' => '{{ns:project}}:Semantic Watchlist administrators',

	'group-swladmins.css' => '/* CSS placed here will affect Semantic watchlist administrators only */', # only translate this message to other languages if you have to change it
	'group-swladmins.js'  => '/* JS placed here will affect Semantic watchlist administrators only */', # only translate this message to other languages if you have to change it

	// Special:WatchlistConditions
	'swl-group-name' => 'Group name:',
	'swl-group-properties' => 'Properties covered by this group:',
	'swl-group-remove-property' => 'Remove property',
	'swl-group-add-property' => 'Add property',
	'swl-group-page-selection' => 'Pages in',
	'swl-group-save' => 'Save',
	'swl-group-saved' => 'Saved',
	'swl-group-saving' => 'Saving',
	'swl-group-delete' => 'Delete',
	'swl-group-category' => 'category',
	'swl-group-namespace' => 'namespace',
	'swl-group-concept' => 'concept',
	'swl-group-confirmdelete' => 'Are you sure you want to delete the "$1" watchlist group?',
	'swl-group-save-all' => 'Save all',
	'swl-group-add-new-group' => 'Add a new group',
	'swl-group-add-group' => 'Add group',

	// Special:SemanticWatchlist
	'swl-watchlist-position' => "Showing '''$1''' of the last {{PLURAL:$1|change|changes}} starting with '''#$2'''.",
	'swl-watchlist-insertions' => 'New:',
	'swl-watchlist-deletions' => 'Old:',
	'swl-watchlist-pagincontrol' => 'View ($1) ($2)',
	'swl-watchlist-firstn' => 'first $1',
	'swl-watchlist-firstn-title' => 'First $1 {{PLURAL:$1|result|results}}',
	'swl-watchlist-no-items' => 'You have no items on your semantic watchlist.',
	'swl-watchlist-can-mod-groups' => 'You can [[$1|modify the watchlist groups]].', 
	'swl-watchlist-can-mod-prefs' => 'You can [[$1|modify your watchlist preferences]], including setting which properties to watch.',
	'swl-watchlist-no-groups' => 'You are not yet watching any watchlist groups. [[$1|Modify your watchlist preferences]].',
	
	// Email
	'swl-email-propschanged' => 'Properties have changed at $1',
	'swl-email-propschanged-long' => "One or more properties you watch at '''$1''' have been changed by user '''$2''' at $4 on $5. You can view these and other changes on [$3 your semantic watchlist].",
	'swl-email-changes' => 'Property changes on [$2 $1]:',

	// Preferences
	'prefs-swl' => 'Semantic watchlist',
	'prefs-swlgroup' => 'Groups to watch',
	'prefs-swlglobal' => 'General options',
	'swl-prefs-emailnofity' => 'E-mail me on changes to properties I am watching',
	'swl-prefs-watchlisttoplink' => 'Show a link to the Semantic Watchlist on the top of the page',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|property|properties}} $3 from category ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|property|properties}} $3 from namespace ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|property|properties}} $3 from concept ''$4''",

	// API
	'swl-err-userid-xor-groupids' => 'Either the userid or the groupids parameter needs to be specified, but not both.',
);

/** Message documentation (Message documentation)
 * @author EugeneZelenko
 * @author Jeroen De Dauw
 * @author Nemo bis
 * @author Siebrand
 * @author Umherirrender
 * @author 아라
 */
$messages['qqq'] = array(
	'semanticwatchlist-desc' => '{{desc}}',
	'right-semanticwatch' => '{{doc-right|semanticwatch}}',
	'right-semanticwatchgroups' => '{{doc-right|semanticwatchgroups}}',
	'group-swladmins' => '{{doc-group|swladmins}}',
	'group-swladmins-member' => '{{doc-group|swladmins|member}}',
	'grouppage-swladmins' => '{{doc-group|swladmins|page}}',
	'group-swladmins.css' => '{{doc-group|swladmins}}',
	'group-swladmins.js' => '{{doc-group|swladmins}}',
	'swl-group-save' => '{{Identical|Save}}',
	'swl-group-saved' => '{{Identical|Saved}}',
	'swl-group-delete' => '{{Identical|Delete}}',
	'swl-group-category' => '{{Identical|Category}}',
	'swl-group-namespace' => '{{Identical|Namespace}}',
	'swl-watchlist-position' => "The message explains how many changes are displayed in the special page ($1) and what's the number of the first one shown ($2): the special page provides results in paginated format.",
	'swl-watchlist-insertions' => '{{Identical|New}}',
	'swl-watchlist-pagincontrol' => '{{Identical|View}}',
	'swl-watchlist-firstn' => '{{Identical|First}}',
	'swl-watchlist-can-mod-groups' => 'Parameters:
* $1 is a wiki link.',
	'swl-watchlist-can-mod-prefs' => 'Parameters:
* $1 is a wiki link.',
	'swl-watchlist-no-groups' => 'Parameters:
* $1 is a wiki link.',
	'swl-email-propschanged-long' => '$1: wiki name, $2: user name, $3: url, $4: time, $5: date',
	'swl-prefs-watchlisttoplink' => 'Description for a MediaWiki preference.',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 */
$messages['af'] = array(
	'swl-group-saved' => 'Gestoor',
);

/** Azerbaijani (azərbaycanca)
 * @author Cekli829
 */
$messages['az'] = array(
	'swl-group-save' => 'Qeyd et',
	'swl-group-delete' => 'Sil',
	'swl-group-category' => 'kateqoriya',
	'swl-watchlist-insertions' => 'Yeni:',
	'swl-watchlist-deletions' => 'Qədim:',
);

/** Belarusian (Taraškievica orthography) (‪беларуская (тарашкевіца)‬)
 * @author Jim-by
 * @author Renessaince
 */
$messages['be-tarask'] = array(
	'swl-group-save' => 'Захаваць',
	'swl-group-saved' => 'Захаваны',
	'swl-group-saving' => 'Захаваньне',
	'swl-group-delete' => 'Выдаліць',
	'swl-group-category' => 'катэгорыя',
	'swl-group-namespace' => 'прастора назваў',
	'swl-group-concept' => 'канцэпт',
	'swl-group-confirmdelete' => 'Вы ўпэўнены, што жадаеце выдаліць групу назіраньня «$1»?',
	'swl-group-save-all' => 'Захаваць усё',
	'swl-group-add-new-group' => 'Дадаць новую групу',
	'swl-group-add-group' => 'Дадаць групу',
	'swl-watchlist-insertions' => 'Новая:',
	'swl-watchlist-deletions' => 'Старая:',
	'swl-watchlist-pagincontrol' => 'Прагляд ($1) ($2)',
	'swl-watchlist-firstn' => 'першая $1',
	'swl-watchlist-can-mod-groups' => 'Вы можаце [[$1|зьмяняць групы сьпісу назіраньня]].',
	'prefs-swlgroup' => 'Групы для назіраньня',
);

/** Bulgarian (български)
 * @author DCLXVI
 */
$messages['bg'] = array(
	'swl-group-save' => 'Съхраняване',
	'swl-group-delete' => 'Изтриване',
);

/** Breton (brezhoneg)
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'swl-group-name' => 'Anv ar strollad :',
	'swl-group-remove-property' => 'Lemel kuit ar perzh',
	'swl-group-add-property' => "Ouzhpennañ ar perc'henniezh",
	'swl-group-page-selection' => 'Pajennoù e',
	'swl-group-save' => 'Enrollañ',
	'swl-group-saved' => 'Enrollet',
	'swl-group-saving' => "Oc'h enrollañ",
	'swl-group-delete' => 'Dilemel',
	'swl-group-category' => 'rummad',
	'swl-group-namespace' => 'esaouenn anv',
	'swl-group-concept' => 'meizad',
	'swl-group-save-all' => 'Enrollañ pep tra',
	'swl-group-add-new-group' => 'Ouzhpennañ ur strollad nevez',
	'swl-group-add-group' => 'Ouzhpennañ ur strollad',
	'swl-watchlist-insertions' => 'Ouzhpennet :',
	'swl-watchlist-deletions' => 'Kozh:',
	'swl-watchlist-pagincontrol' => 'Gwelet ($1) ($2)',
	'swl-watchlist-firstn' => 'Ar $1 kentañ',
	'swl-watchlist-firstn-title' => "Ar $1 {{PLURAL:$1|disoc'h kentañ|disoc'h kentañ}}",
	'prefs-swlgroup' => 'Strolladoù da vezañ evezhiet',
	'prefs-swlglobal' => 'Dibarzhioù hollek',
);

/** Catalan (català)
 * @author Toniher
 */
$messages['ca'] = array(
	'swl-group-name' => 'Nom del grup:',
	'swl-group-remove-property' => 'Suprimeix la propietat',
	'swl-group-add-property' => 'Afegeix la propietat',
	'swl-group-save' => 'Desa',
	'swl-group-saved' => 'Desat',
	'swl-group-saving' => "S'està desant",
	'swl-group-delete' => 'Suprimeix',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'espai de noms',
	'swl-group-concept' => 'concepte',
	'swl-group-confirmdelete' => 'Esteu segur que voleu suprimir el grup de seguiment «$1»?',
	'swl-group-save-all' => 'Desa-ho tot',
	'swl-group-add-new-group' => 'Afegeix un grup nou',
	'swl-group-add-group' => 'Afegeix un grup',
	'swl-watchlist-insertions' => 'Nou:',
	'swl-watchlist-deletions' => 'Antic:',
	'swl-email-propschanged' => 'Les propietats han canviat a $1',
	'prefs-swlgroup' => 'Grups a vigilar',
	'prefs-swlglobal' => 'Opcions generals',
	'swl-prefs-emailnofity' => "Envia'm un correu electrònic quan hi hagi canvis en les propietats que segueixo",
);

/** Czech (česky)
 * @author Vks
 */
$messages['cs'] = array(
	'swl-group-name' => 'Jméno skupiny:',
	'swl-group-properties' => 'Atributy této skupiny:',
	'swl-group-remove-property' => 'Odstranit atribut',
	'swl-group-add-property' => 'Přidat atribut',
	'swl-group-page-selection' => 'Stránky v',
	'swl-group-save' => 'Uložit',
	'swl-group-saved' => 'Uložené',
	'swl-group-saving' => 'Ukládá se',
	'swl-group-delete' => 'Smazat',
	'swl-group-category' => 'kategorie',
	'swl-group-namespace' => 'jmenný prostor',
	'swl-group-concept' => 'koncept',
	'swl-group-confirmdelete' => 'Jste si jisti, že chtete smazat sledovanou skupinu "$1"?',
	'swl-group-save-all' => 'Uložit vše',
	'swl-group-add-new-group' => 'Přidat novou skupinu',
	'swl-group-add-group' => 'Přidat skupinu',
	'swl-watchlist-insertions' => 'Nové:',
	'swl-watchlist-deletions' => 'Staré:',
	'swl-watchlist-pagincontrol' => 'Ukázat ($1) ($2)',
	'swl-watchlist-firstn' => 'první $1',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 * @author Purodha
 */
$messages['de'] = array(
	'semanticwatchlist-desc' => 'Ermöglicht die Benachrichtigung von Benutzern zu bestimmten Änderungen an semantischen Daten',
	'right-semanticwatch' => 'Semantische Beobachtungslisten verwenden',
	'right-semanticwatchgroups' => 'Semantische Beobachtungslisten [[Special:WatchlistConditions|anpassen]]',
	'special-semanticwatchlist' => 'Semantische Beobachtungsliste',
	'special-watchlistconditions' => 'Einstellungen zu semantischen Beobachtungslisten',
	'group-swladmins' => 'SWL-Administratoren',
	'group-swladmins-member' => '{{GENDER:$1|SWL-Administrator|SWL-Administratorin}}',
	'grouppage-swladmins' => '{{ns:project}}:SWL-Administratoren',
	'swl-group-name' => 'Gruppenname:',
	'swl-group-properties' => 'Attribute zu dieser Gruppe:',
	'swl-group-remove-property' => 'Attribut entfernen',
	'swl-group-add-property' => 'Attribut hinzufügen',
	'swl-group-page-selection' => 'Seiten in',
	'swl-group-save' => 'Speichern',
	'swl-group-saved' => 'Gespeichert',
	'swl-group-saving' => 'Am Speichern …',
	'swl-group-delete' => 'Löschen',
	'swl-group-category' => 'Kategorie',
	'swl-group-namespace' => 'Namensraum',
	'swl-group-concept' => 'Konzept',
	'swl-group-confirmdelete' => 'Soll die Beobachtungsliste „$1“ tatsächlich gelöscht werden?',
	'swl-group-save-all' => 'Alle speichern',
	'swl-group-add-new-group' => 'Eine neue Gruppe hinzufügen',
	'swl-group-add-group' => 'Eine Gruppe hinzufügen',
	'swl-watchlist-position' => "Anzeige der letzten '''$1''' Änderungen beginnend mit '''#$2'''.",
	'swl-watchlist-insertions' => 'Hinzugefügt:',
	'swl-watchlist-deletions' => 'Alt:',
	'swl-watchlist-pagincontrol' => 'Zeige ($1) ($2)',
	'swl-watchlist-firstn' => 'erstes $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Das erste Ergebnis|Die ersten $1 Ergebnisse}}',
	'swl-watchlist-no-items' => 'Es befinden sich keine Einträge auf deiner Beobachtungsliste.',
	'swl-watchlist-can-mod-groups' => 'Du kannst [[$1|die Gruppen]] anpassen.',
	'swl-watchlist-can-mod-prefs' => 'Du kannst [[$1|die Einstellungen der semantischen Beobachtungsliste]], einschließlich der zu beobachtenden Attribute, anpassen.',
	'swl-watchlist-no-groups' => 'Du beobachtest bislang noch keine Gruppen. [[$1|Pass deine Einstellungen an]].',
	'swl-email-propschanged' => 'Attribute wurden auf $1 geändert',
	'swl-email-propschanged-long' => "Eines oder mehrere der auf '''$1''' beobachteten Attribute wurden von Benutzer '''$2''' am $5 um $4 Uhr geändert. Diese und andere Änderungen werden auf [$3 dieser semantischen Beobachtungsliste] angezeigt.",
	'swl-email-changes' => 'Attributänderungen auf [$2 $1]:',
	'prefs-swl' => 'Semantische Beobachtungsliste',
	'prefs-swlgroup' => 'Zu beobachtende Gruppen',
	'prefs-swlglobal' => 'Allgemeine Optionen',
	'swl-prefs-emailnofity' => 'Bei Änderungen an beobachteten Attributen E-Mails senden',
	'swl-prefs-watchlisttoplink' => 'Einen Link zur semantischen Beobachtungsliste oben auf der Seite im Benutzermenü anzeigen',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 in Kategorie ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 im Namensraum ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 im Konzept ''$4''",
	'swl-err-userid-xor-groupids' => 'Es muss entweder der Parameter für die Benutzerkennung oder für die Gruppenkennung angegeben werden, jedoch nicht beide gleichzeitig.',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'swl-watchlist-no-items' => 'Es befinden sich keine Einträge auf Ihrer Beobachtungsliste.',
	'swl-watchlist-can-mod-groups' => 'Sie können [[$1|die Gruppen]] anpassen.',
	'swl-watchlist-can-mod-prefs' => 'Sie können [[$1|die Einstellungen der semantischen Beobachtungsliste]], einschließlich der zu beobachtenden Attribute, anpassen.',
	'swl-watchlist-no-groups' => 'Sie beobachten bislang noch keine Gruppen. [[$1|Passen Sie Ihre Einstellungen an]].',
);

/** Zazaki (Zazaki)
 * @author Mirzali
 */
$messages['diq'] = array(
	'swl-group-category' => 'kategoriye',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'right-semanticwatch' => 'semantisku wobglědowańsku lisćinu wužywaś',
	'right-semanticwatchgroups' => 'Kupki semantiskeje wobglěodwanskeje lisćiny [[Special:WatchlistConditions|změniś]]',
	'special-semanticwatchlist' => 'Semantiska wobglědowańska lisćina',
	'special-watchlistconditions' => 'Wuměnjenja semantiskeje wobglědowańskeje lisćiny',
	'group-swladmins' => 'Administratory semantiskeje wobglědowańskeje lisćiny',
	'group-swladmins-member' => '{{GENDER:$1|Administrator|Administratorka}} semantiskeje wobglědowańskeje lisćiny',
	'grouppage-swladmins' => '{{ns:project}}:Administratory semantiskeje wobglědowańskeje lisćiny',
	'swl-group-name' => 'Mě kupki:',
	'swl-group-properties' => 'Kakosći toś teje kupki:',
	'swl-group-remove-property' => 'Kakosć wótpóraś',
	'swl-group-add-property' => 'Kakosć pśidaś',
	'swl-group-page-selection' => 'Boki w',
	'swl-group-save' => 'Składowaś',
	'swl-group-saved' => 'Składowany',
	'swl-group-saving' => 'Składujo se',
	'swl-group-delete' => 'Wulašowaś',
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'mjenjowy rum',
	'swl-group-concept' => 'koncept',
	'swl-group-confirmdelete' => 'Coš napšawdu kupku "$1" wobglědowańskeje lisćiny lašowaś?',
	'swl-group-save-all' => 'Wšykno składowaś',
	'swl-group-add-new-group' => 'Nowu kupku pśidaś',
	'swl-group-add-group' => 'Kupku pśidaś',
	'swl-watchlist-position' => "{{PLURAL:$1|Pokazujo|Pokazujotej|Pokazuju|Pokazujo}} se '''$1''' {{PLURAL:$1|slědna změna|slědnjej změnje|slědne změny|slědnych změnow}}, zachopinajucy z '''$2'''.",
	'swl-watchlist-insertions' => 'Nowy:',
	'swl-watchlist-deletions' => 'Stary:',
	'swl-watchlist-pagincontrol' => '($1) ($2) pokazaś',
	'swl-watchlist-firstn' => 'prědny $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Prědny wuslědk|Prědnej $1 wuslědka|Prědne $1 wuslědki|Prědnych $1 wuslědkow}}',
	'swl-watchlist-no-items' => 'Njamaš žedne zapiski w swójej semantiskej wobglědowańskej lisćinje.',
	'swl-watchlist-can-mod-groups' => 'Móžoš [[$1|kupki wobglědowańskeje lisćiny změniś]].',
	'swl-email-propschanged' => 'Kakosći su se do $1 změnili',
	'swl-email-changes' => 'Změny kakosćow na [$2 $1]:',
	'prefs-swl' => 'Semantiska wobglědowańska lisćina',
	'prefs-swlgroup' => 'Kupki, kótarež maju se wobglědowaś',
	'prefs-swlglobal' => 'Powšykne opcije',
	'swl-prefs-emailnofity' => 'Wó změnach na kakosćach, kótarež se woglěduju, e-mail pósłaś',
	'swl-prefs-watchlisttoplink' => 'Wótkaz k semantiskej wobglědowańskej lisćinje górjejce na boku pokazaś',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|kakosć|kakosći|kakosći|kakosći}} $3 z kategorije ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|kakosć|kakosći|kakosći|kakosći}} $3 z mjenjowego ruma ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|kakosć|kakosći|kakosći|kakosći}} $3 z koncepta ''$4''",
);

/** Spanish (español)
 * @author Armando-Martin
 * @author Invadinado
 * @author Mor
 */
$messages['es'] = array(
	'semanticwatchlist-desc' => 'Permite a los usuarios recibir notificaciones sobre cambios específicos hechos en los datos de Semantic MediaWiki',
	'right-semanticwatch' => 'Utilizar la lista de vigilancia semántica',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Modificar]] los grupos de la lista de vigilancia semántica',
	'special-semanticwatchlist' => 'Lista de vigilancia semántica',
	'special-watchlistconditions' => 'Condiciones de la lista de vigilancia semántica',
	'group-swladmins' => 'Administradores de la lista de vigilancia semántica',
	'group-swladmins-member' => '{{GENDER:$1|administrador|administradora}} de la lista de vigilancia semántica',
	'grouppage-swladmins' => '{{ns:project}}:Administradores de la lista de vigilancia semántica',
	'swl-group-name' => 'Nombre del grupo:',
	'swl-group-properties' => 'Propiedades cubiertas por este grupo:',
	'swl-group-remove-property' => 'Quitar propiedad',
	'swl-group-add-property' => 'Añadir propiedad',
	'swl-group-page-selection' => 'Páginas en',
	'swl-group-save' => 'Guardar',
	'swl-group-saved' => 'Guardado',
	'swl-group-saving' => 'Guardando',
	'swl-group-delete' => 'Borrar',
	'swl-group-category' => 'categoría',
	'swl-group-namespace' => 'espacio de nombres',
	'swl-group-concept' => 'concepto',
	'swl-group-confirmdelete' => '¿Está seguro de querer borrar el grupo de la lista de vigilancia "$1"?',
	'swl-group-save-all' => 'Guardar todo',
	'swl-group-add-new-group' => 'Añadir un nuevo grupo',
	'swl-group-add-group' => 'Añadir grupo',
	'swl-watchlist-position' => "Mostrando {{PLURAL:$1|el último cambio|los '''$1''' últimos cambios}}, comezando por el '''# $2'''.",
	'swl-watchlist-insertions' => 'Añadido:',
	'swl-watchlist-deletions' => 'Antiguo:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => '$1 primeras',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|primer resultado|$1 primeros resultados}}',
	'swl-watchlist-no-items' => 'No tiene ningún elemento en su lista de vigilancia semántica.',
	'swl-watchlist-can-mod-groups' => 'Puede [[$1|modificar los grupos de la lista de vigilancia]].',
	'swl-watchlist-can-mod-prefs' => 'Puede [[$1|modificar las preferencias de su lista de vigilancia]], incluidas las propiedades que quiera vigilar.',
	'swl-watchlist-no-groups' => 'Aún no estás vigilando ningún grupo de la lista de seguimiento. [[$1|Modifica las preferencias de tu lista de seguimiento]].',
	'swl-email-propschanged' => 'Las propiedades han cambiado en $1',
	'swl-email-propschanged-long' => "El usuario '''$2''' ha modificado una o más propiedades que vigila en '''$1''' el $5 a las $4. Puede ver estas y otras modificaciones [$3 en su lista de vigilancia semántica].",
	'swl-email-changes' => 'Cambio de propiedades en [$2 $1]:',
	'prefs-swl' => 'Lista de vigilancia semántica',
	'prefs-swlgroup' => 'Grupos a vigilar',
	'prefs-swlglobal' => 'Opciones generales',
	'swl-prefs-emailnofity' => 'Enviarme un mensaje de correo electrónico sobre los cambios en las propiedades que estoy vigilando',
	'swl-prefs-watchlisttoplink' => 'Mostrar un enlace a la lista de vigilancia semántica en la parte superior de la página',
	'swl-prefs-category-label' => "'''$1:''' {{PLURAL:$2|propiedad|propiedades}} $3 de la categoría ''$4''",
	'swl-prefs-namespace-label' => "'''$1:''' {{PLURAL:$2|propiedad|propiedades}} $3 del espacio de nombres ''$4''",
	'swl-prefs-concept-label' => "'''$1:''' {{PLURAL:$2|propiedad|propiedades}} $3 del concepto ''$4''",
	'swl-err-userid-xor-groupids' => 'Debe especificar el parámetro de identificación de usuario o el parámetro de identificación de grupo, pero no ambos.',
);

/** Estonian (eesti)
 * @author Avjoska
 */
$messages['et'] = array(
	'swl-group-save' => 'Salvesta',
	'swl-group-saved' => 'Salvestatud',
	'swl-group-saving' => 'Salvestamisel',
	'swl-group-delete' => 'Kustuta',
	'swl-group-category' => 'kategooria',
	'swl-group-namespace' => 'nimeruum',
	'swl-group-save-all' => 'Salvesta kõik',
	'swl-group-add-new-group' => 'Lisa uus rühm',
	'swl-group-add-group' => 'Lisa rühm',
	'swl-watchlist-insertions' => 'Uus:',
	'swl-watchlist-deletions' => 'Vana:',
);

/** Persian (فارسی)
 * @author Mjbmr
 */
$messages['fa'] = array(
	'swl-group-save-all' => 'ذخیرهٔ همه',
	'swl-watchlist-insertions' => 'جدید:',
	'swl-watchlist-deletions' => 'قدیمی:',
);

/** Finnish (suomi)
 * @author Crt
 */
$messages['fi'] = array(
	'swl-group-save' => 'Tallenna',
);

/** French (français)
 * @author Gomoko
 * @author IAlex
 * @author Sherbrooke
 */
$messages['fr'] = array(
	'semanticwatchlist-desc' => "Permet aux utilisateurs d'être avertis de modifications spécifiques dans les données de MediaWiki sémantique",
	'right-semanticwatch' => 'Utiliser la liste de suivi sémantique',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Modifier]] les groupes de la liste de suivi sémantique',
	'special-semanticwatchlist' => 'Liste de suivi sémantique',
	'special-watchlistconditions' => 'Paramètres de la liste de suivi sémantique',
	'group-swladmins' => 'Administrateurs de la liste de suivi sémantique',
	'group-swladmins-member' => '{{GENDER:$1|Administrateur de la liste de suivi sémantique}}',
	'grouppage-swladmins' => '{{ns:project}}:Semantic_Watchlist_admins',
	'swl-group-name' => 'Nom du groupe:',
	'swl-group-properties' => 'Propriétés de ce groupe :',
	'swl-group-remove-property' => 'Retirez la propriété',
	'swl-group-add-property' => 'Ajouter une propriété',
	'swl-group-page-selection' => 'Pages dans la',
	'swl-group-save' => 'Enregistrer',
	'swl-group-saved' => 'Enregistré',
	'swl-group-saving' => 'Enregistrement en cours',
	'swl-group-delete' => 'Supprimer',
	'swl-group-category' => 'catégorie',
	'swl-group-namespace' => 'espace de noms',
	'swl-group-concept' => 'concept',
	'swl-group-confirmdelete' => 'Etes-vous certain de vouloir supprimer le groupe de liste d\'alerte "$1" ?',
	'swl-group-save-all' => 'Enregistrer tout',
	'swl-group-add-new-group' => 'Ajouter un nouveau groupe',
	'swl-group-add-group' => 'Ajouter un groupe',
	'swl-watchlist-position' => "'''Afficher $1''' des derniers changements en commençant par '''#$2'''.",
	'swl-watchlist-insertions' => 'Ajouté :',
	'swl-watchlist-deletions' => 'Ancien:',
	'swl-watchlist-pagincontrol' => 'Voir ($1) ($2)',
	'swl-watchlist-firstn' => '$1 premiers',
	'swl-watchlist-firstn-title' => '$1 {{PLURAL:$1|permier résultat|premiers résultats}}',
	'swl-watchlist-no-items' => "Vous n'avez aucun élément dans votre liste de suivi sémantique.",
	'swl-watchlist-can-mod-groups' => 'Vous pouvez [[$1|modifier les groupes de la liste de suivi]].',
	'swl-watchlist-can-mod-prefs' => 'Vous pouvez [[$1|modifier les préférences de votre liste de suivi]], y compris la définition des propriétés à suivre.',
	'swl-watchlist-no-groups' => 'Vous ne suivez pour le moment aucun groupe de liste de suivi. [[$1|Modifiez vos préférences de liste de suivi]].',
	'swl-email-propschanged' => 'Les propriétés ont changé à $1',
	'swl-email-propschanged-long' => "Une ou plusieurs propriétés que vous suivez à '''$1'' ont été modifiées par l'utilisateur '''$2''' à $4 sur $5 . Vous pouvez visualiser ces modifications et d'autres sur [$3 votre liste de suivi sémantique].",
	'swl-email-changes' => 'Changements de propriétés sur [$2 $1] :',
	'prefs-swl' => 'Liste de suivi sémantique',
	'prefs-swlgroup' => 'Groupes à suivre',
	'prefs-swlglobal' => 'Options générales',
	'swl-prefs-emailnofity' => "Envoyez-moi un courriel sur les modifications apportées aux propriétés que j'ai en liste de suivi",
	'swl-prefs-watchlisttoplink' => 'Afficher un lien vers la liste de suivi sémantique en haut de la page',
	'swl-prefs-category-label' => "'''$1''' : {{PLURAL:$2| propriété|propriétés}} $3 de la catégorie ''$4''",
	'swl-prefs-namespace-label' => "'''$1''' : {{PLURAL:$2|propriété|propriétés}} $3 de l'espace de noms ''$4''",
	'swl-prefs-concept-label' => "'''$1''' : {{PLURAL:$2|propriété|propriétés}} $3 du concept ''$4''",
	'swl-err-userid-xor-groupids' => 'Il faut spécifier <code>userid</code> ou <code>groupid</code>, mais pas les deux en même temps.',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'right-semanticwatch' => 'Utilisar la lista de survelyence sèmantica',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Changiér]] les tropes de la lista de survelyence sèmantica',
	'special-semanticwatchlist' => 'Lista de survelyence sèmantica',
	'special-watchlistconditions' => 'Paramètres de la lista de survelyence sèmantica',
	'group-swladmins' => 'Administrators de la lista de survelyence sèmantica',
	'group-swladmins-member' => 'administrat{{GENDER:$1|or|rice}} de la lista de survelyence sèmantica',
	'grouppage-swladmins' => '{{ns:project}}:Administrators_de_la_lista_de_survelyence_sèmantica',
	'swl-group-name' => 'Nom de la tropa :',
	'swl-group-properties' => 'Propriètâts de ceta tropa :',
	'swl-group-remove-property' => 'Enlevar una propriètât',
	'swl-group-add-property' => 'Apondre una propriètât',
	'swl-group-page-selection' => 'Pâges dens la',
	'swl-group-save' => 'Encartar',
	'swl-group-saved' => 'Encartâ',
	'swl-group-saving' => 'Encartâjo en cors',
	'swl-group-delete' => 'Suprimar',
	'swl-group-category' => 'catègorie',
	'swl-group-namespace' => 'èspâço de noms',
	'swl-group-concept' => 'concèpte',
	'swl-group-confirmdelete' => 'Éte-vos de sûr de volêr suprimar la tropa de la lista de survelyence « $1 » ?',
	'swl-group-save-all' => 'Encartar tot',
	'swl-group-add-new-group' => 'Apondre una tropa novèla',
	'swl-group-add-group' => 'Apondre una tropa',
	'swl-watchlist-position' => "Fâre vêre '''$1''' des dèrriérs changements en comencient per '''#$2'''.",
	'swl-watchlist-insertions' => 'Apondu :',
	'swl-watchlist-deletions' => 'Viely :',
	'swl-watchlist-pagincontrol' => 'Vêre ($1) ($2)',
	'swl-watchlist-firstn' => '$1 premiérs',
	'swl-watchlist-firstn-title' => '$1 {{PLURAL:$1|premiér rèsultat|premiérs rèsultats}}',
	'swl-email-propschanged' => 'Les propriètâts ont changiês a $1',
	'swl-email-changes' => 'Changements de propriètâts sur [$2 $1] :',
	'prefs-swl' => 'Lista de survelyence sèmantica',
	'prefs-swlgroup' => 'Tropes a siuvre',
	'prefs-swlglobal' => 'Chouèx g·ènèrals',
	'swl-prefs-category-label' => "'''$1''' : propriètât{{PLURAL:$2||s}} $3 de la catègorie ''$4''",
	'swl-prefs-namespace-label' => "'''$1''' : propriètât{{PLURAL:$2||s}} $3 de l’èspâço de noms ''$4''",
	'swl-prefs-concept-label' => "'''$1''' : propriètât{{PLURAL:$2||s}} $3 du concèpte ''$4''",
);

/** Irish (Gaeilge)
 * @author පසිඳු කාවින්ද
 */
$messages['ga'] = array(
	'swl-group-save' => 'Sábháil',
	'swl-group-delete' => 'Scrios',
	'swl-group-category' => 'catagóir',
	'swl-group-namespace' => 'Ainmspás',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'semanticwatchlist-desc' => 'Permite aos usuarios recibir notificacións sobre cambios específicos feitos nos datos de Semantic MediaWiki',
	'right-semanticwatch' => 'Empregar a lista de vixilancia semántica',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Modificar]] os grupos da lista de vixilancia semántica',
	'special-semanticwatchlist' => 'Lista de vixilancia semántica',
	'special-watchlistconditions' => 'Condicións da lista de vixilancia semántica',
	'group-swladmins' => 'Administradores da lista de vixilancia semántica',
	'group-swladmins-member' => '{{GENDER:$1|administrador|administradora}} da lista de vixilancia semántica',
	'grouppage-swladmins' => '{{ns:project}}:Administradores da lista de vixilancia semántica',
	'swl-group-name' => 'Nome do grupo:',
	'swl-group-properties' => 'Propiedades cubertas por este grupo:',
	'swl-group-remove-property' => 'Eliminar a propiedade',
	'swl-group-add-property' => 'Engadir a propiedade',
	'swl-group-page-selection' => 'Páxinas en',
	'swl-group-save' => 'Gardar',
	'swl-group-saved' => 'Gardado',
	'swl-group-saving' => 'Gardando',
	'swl-group-delete' => 'Borrar',
	'swl-group-category' => 'categoría',
	'swl-group-namespace' => 'espazo de nomes',
	'swl-group-concept' => 'concepto',
	'swl-group-confirmdelete' => 'Está seguro de querer borrar o grupo da lista de vixilancia "$1"?',
	'swl-group-save-all' => 'Gardar todos',
	'swl-group-add-new-group' => 'Engadir un novo grupo',
	'swl-group-add-group' => 'Engadir o grupo',
	'swl-watchlist-position' => "Mostrando '''$1''' dos últimos cambios, comezando polo '''nº $2'''.",
	'swl-watchlist-insertions' => 'Engadido:',
	'swl-watchlist-deletions' => 'Vello:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => '$1 primeiras',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Primeiro resultado|Primeiros $1 resultados}}',
	'swl-watchlist-no-items' => 'Non ten elementos na súa lista de vixilancia semántica.',
	'swl-watchlist-can-mod-groups' => 'Pode [[$1|modificar os grupos da lista de vixilancia]].',
	'swl-watchlist-can-mod-prefs' => 'Pode [[$1|modificar as preferencias da súa lista de vixilancia]], incluídas as propiedades que queira vixiar.',
	'swl-watchlist-no-groups' => 'Aínda non está a vixiar ningún dos grupos da lista de vixilancia. [[$1|Modifique as preferencias da súa lista de vixilancia]].',
	'swl-email-propschanged' => 'As propiedades cambiaron ás $1',
	'swl-email-propschanged-long' => "O usuario '''$2''' modificou unha ou máis propiedades que vixía en '''$1''' o $5 ás $4. Pode ollar estas e outras modificacións [$3 na súa lista de vixilancia semántica].",
	'swl-email-changes' => 'Cambio nas propiedades en [$2 $1]:',
	'prefs-swl' => 'Lista de vixilancia semántica',
	'prefs-swlgroup' => 'Grupos a vixiar',
	'prefs-swlglobal' => 'Opcións xerais',
	'swl-prefs-emailnofity' => 'Enviádeme un correo electrónico se hai cambios nas propiedades que vixío',
	'swl-prefs-watchlisttoplink' => 'Mostrar unha ligazón cara á lista de vixilancia semántica na parte superior da páxina',
	'swl-prefs-category-label' => "'''$1:''' {{PLURAL:$2|propiedade|propiedades}} $3 da categoría ''$4''",
	'swl-prefs-namespace-label' => "'''$1:''' {{PLURAL:$2|propiedade|propiedades}} $3 do espazo de nomes ''$4''",
	'swl-prefs-concept-label' => "'''$1:''' {{PLURAL:$2|propiedade|propiedades}} $3 do concepto ''$4''",
	'swl-err-userid-xor-groupids' => 'Cómpre especificar ou ben o parámetro de identificación de usuario ou o parámetro de identificación de grupo, pero non os dous.',
);

/** Swiss German (Alemannisch)
 * @author Als-Chlämens
 */
$messages['gsw'] = array(
	'swl-group-name' => 'Gruppename:',
	'swl-group-properties' => 'Attribut vo derre Grupp:',
	'swl-group-remove-property' => 'Attribut ussenee',
	'swl-group-add-property' => 'Attribut dezuefiege',
	'swl-group-page-selection' => 'Syte in',
	'swl-group-save' => 'Spychere',
	'swl-group-saved' => 'Gspycheret',
	'swl-group-saving' => 'Am Spychere',
	'swl-group-delete' => 'Lösche',
	'swl-group-category' => 'Kategorii',
	'swl-group-namespace' => 'Namensruum',
	'swl-group-concept' => 'Konzept',
	'swl-group-save-all' => 'Alli spyychere',
	'swl-group-add-new-group' => 'E neji Grupp dezuefiege',
	'swl-group-add-group' => 'E Gruppe dezuefiege',
	'swl-watchlist-insertions' => 'Nej:',
	'swl-watchlist-deletions' => 'Alt:',
	'swl-watchlist-pagincontrol' => 'Zeig ($1) ($2)',
	'swl-watchlist-firstn' => 'erschts $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Erschts Ergebnis|Erschti $1 Ergebnis}}',
	'swl-watchlist-no-items' => 'Du hesch ke Yträg uf dyre Beobachtigslischte.',
	'swl-watchlist-can-mod-groups' => 'Du chasch [[$1|die Gruppe]] aapasse..',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author Inkbug
 */
$messages['he'] = array(
	'semanticwatchlist-desc' => 'מאפשרת למשתמשים לקבל הודעה על שינויים מסוימים בנתונים של מדיה־ויקי סמנטית',
	'right-semanticwatch' => 'שימוש ברשימת מעקב סמנטית',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|שינוי]] קבוצות רשימת מעקב סמנטית',
	'special-semanticwatchlist' => 'רשימת מעקב סמנטית',
	'swl-group-save' => 'שמירה',
	'swl-prefs-emailnofity' => 'לשלוח אליי דואר אלקטרוני כאשר יש שינוי במאפיינים במעקב שלי',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'semanticwatchlist-desc' => 'Zmóžnja zdźělenje wěstych změnow na semantiskich datach',
	'right-semanticwatch' => 'Semantisku wobkedźbowansku lisćinu wužiwać',
	'right-semanticwatchgroups' => 'Skupiny semantiskeje wobkedźbowanskeje lisćiny [[Special:WatchlistConditions|změnić]]',
	'special-semanticwatchlist' => 'Semantiska wobkedźbowanska lisćina',
	'special-watchlistconditions' => 'Wuměnjenja semantiskeje wobkedźbowanskeje lisćiny',
	'group-swladmins' => 'Administratorojo semantiskeje wobkedźbowanskeje lisćiny',
	'group-swladmins-member' => '{{GENDER:$1|Administrator|Administratorka}} semantiskeje wobkedźbowanskeje lisćiny',
	'grouppage-swladmins' => '{{ns:project}}:Administratorojo semantiskeje wobkedźbowanskeje lisćiny',
	'swl-group-name' => 'Mjeno skupiny:',
	'swl-group-properties' => 'Kajkosće tuteje skupiny:',
	'swl-group-remove-property' => 'Kajkosć wotstronić',
	'swl-group-add-property' => 'Kajkosć přidać',
	'swl-group-page-selection' => 'Strony w',
	'swl-group-save' => 'Składować',
	'swl-group-saved' => 'Składowany',
	'swl-group-saving' => 'Składuje so',
	'swl-group-delete' => 'Zhašeć',
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'mjenowy rum',
	'swl-group-concept' => 'Koncept',
	'swl-group-confirmdelete' => 'Chceš woprawdźe skupinu wobkedźbowanskeje lisćiny "$1" zhašeć?',
	'swl-group-save-all' => 'Wšě składować',
	'swl-group-add-new-group' => 'Nowu skupinu přidać',
	'swl-group-add-group' => 'Skupinu přidać',
	'swl-watchlist-position' => "{{PLURAL:$1|Pokazuje|Pokazujetej|Pokazuja|Pokazuje}} so '''$1''' {{PLURAL:$1|poslednja změna|poslednjej změnje|poslednje změny|poslednich změnow}}, započinajo z '''$2'''.",
	'swl-watchlist-insertions' => 'Nowy:',
	'swl-watchlist-deletions' => 'Stary:',
	'swl-watchlist-pagincontrol' => '($1) ($2) pokazać',
	'swl-watchlist-firstn' => 'prěni $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Prěni wuslědk|Prěnjej $1 wuslědkaj|Prěnje $1 wuslědki|Prěnich $1 wuslědkow}}',
	'swl-watchlist-no-items' => 'Nimaš žane zapiski w swojej semantiskej wobkedźbowanskej lisćinje.',
	'swl-watchlist-can-mod-groups' => 'Móžeš [[$1|skupiny wobkedźbowanskeje lisćiny změnić]].',
	'swl-watchlist-can-mod-prefs' => 'Móžeš [[$1| nastajenja swojeje wobkedźbowanskeje lisćiny změnić]], inkluziwnje nastajenje, kotre kajkosće maja so wobkedźbować.',
	'swl-watchlist-no-groups' => 'Hišće njewobkedźbuješ wobkedźbowanske skupiny. [[$1|Změń swoje nastajenja za wobkedźbowanske lisćiny]].',
	'swl-email-propschanged' => 'Kajkosće su so do $1 změnili',
	'swl-email-propschanged-long' => "Jedna kajkosć abo wjacore kajkosće, kotrež wobkedźbuješ na '''$1''', su so wot wužiwarja '''$2''' $5 w $4 změnili. Móžeš sej tute a druhe změny na [$3 swojej semantiskej wobkedźbowanskej lisćinje] wobhladać.",
	'swl-email-changes' => 'Změny kajkosćow na [$2 $1]:',
	'prefs-swl' => 'Semantiska wobkedźbowanska lisćina',
	'prefs-swlgroup' => 'Skupiny, kotrež maja so wobkedźbować',
	'prefs-swlglobal' => 'Powšitkowne opcije',
	'swl-prefs-emailnofity' => 'Wo změnach na kajkosćach, kotrež so wobkedźbuja, e-mejl pósłać',
	'swl-prefs-watchlisttoplink' => 'Wotkaz k semantiskej wobkedźbowanskej lisćinje horjeka na stronje pokazać',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|kajkosć|kajkosći|kajkosće|kajkosće}} $3 z kategorije ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|kajkosć|kajkosći|kajkosće|kajkosće}} $3 z mjenoweho ruma ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|kajkosć|kajkosći|kajkosće|kajkosće}} $3 z koncepta ''$4''",
	'swl-err-userid-xor-groupids' => 'Pak parameter ID wužiwarja pak parameter ID skupiny dyrbi so podać, ale nic wobaj.',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'semanticwatchlist-desc' => 'Permitte que usatores recipe notification de cambiamentos specific in datos de Semantic MediaWiki',
	'right-semanticwatch' => 'Usar observatorio semantic',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Modificar]] le gruppos del observatorio semantic',
	'special-semanticwatchlist' => 'Observatorio semantic',
	'special-watchlistconditions' => 'Conditiones del observatorio semantic',
	'group-swladmins' => 'Administratores del observatorio semantic',
	'group-swladmins-member' => '{{GENDER:$1|administrator|administratrice}} del observatorio semantic',
	'grouppage-swladmins' => '{{ns:project}}:Administratores_del_observatorio_semantic',
	'swl-group-name' => 'Nomine del gruppo:',
	'swl-group-properties' => 'Proprietates coperite per iste gruppo:',
	'swl-group-remove-property' => 'Remover proprietate',
	'swl-group-add-property' => 'Adder proprietate',
	'swl-group-page-selection' => 'Paginas in',
	'swl-group-save' => 'Salveguardar',
	'swl-group-saved' => 'Salveguardate',
	'swl-group-saving' => 'Salveguarda in curso',
	'swl-group-delete' => 'Deler',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'spatio de nomines',
	'swl-group-concept' => 'concepto',
	'swl-group-confirmdelete' => 'Es tu secur de voler deler le gruppo "$1" del observatorio?',
	'swl-group-save-all' => 'Salveguardar totes',
	'swl-group-add-new-group' => 'Adder un nove gruppo',
	'swl-group-add-group' => 'Adder gruppo',
	'swl-watchlist-position' => "Presenta '''$1''' del ultime modificationes a partir del '''№ $2'''.",
	'swl-watchlist-insertions' => 'Addite:',
	'swl-watchlist-deletions' => 'Ancian:',
	'swl-watchlist-pagincontrol' => 'Vider ($1) ($2)',
	'swl-watchlist-firstn' => 'prime $1',
	'swl-watchlist-firstn-title' => 'Le prime {{PLURAL:$1|resultato|$1 resultatos}}',
	'swl-watchlist-no-items' => 'Tu non ha elementos sub observation.',
	'swl-watchlist-can-mod-groups' => 'Tu pote [[$1|modificar le gruppos del observatorio]].',
	'swl-watchlist-can-mod-prefs' => 'Tu pote [[$1|modificar le preferentias de tu observatorio]], p.ex. specificar le proprietates a observar.',
	'swl-watchlist-no-groups' => 'Tu non ancora observa un gruppo de observatorio. [[$1|Modifica le preferentias de tu observatorio]].',
	'swl-email-propschanged' => 'Proprietates ha cambiate a $1',
	'swl-email-propschanged-long' => "Un o plus proprietates que tu observa a '''$1''' ha essite cambiate per le usator '''$2''' le $5 a $4. Tu pote vider iste e altere cambios in [$3 tu observatorio semantic].",
	'swl-email-changes' => 'Cambios de proprietate in [$2 $1]:',
	'prefs-swl' => 'Observatorio semantic',
	'prefs-swlgroup' => 'Gruppos a observar',
	'prefs-swlglobal' => 'Optiones general',
	'swl-prefs-emailnofity' => 'Inviar me e-mail in caso de modificationes in proprietates que io observa',
	'swl-prefs-watchlisttoplink' => 'Monstrar un ligamine al observatorio semantic al initio del pagina',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|proprietate|proprietates}} $3 del categoria ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|proprietate|proprietates}} $3 del spatio de nomines ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|proprietate|proprietates}} $3 del concepto ''$4''",
	'swl-err-userid-xor-groupids' => 'O le parametro "userid" o le "groupids" debe esser specificate, ma non ambes.',
);

/** Indonesian (Bahasa Indonesia)
 * @author IvanLanin
 */
$messages['id'] = array(
	'semanticwatchlist-desc' => 'Memungkinkan penetapan kelompok properti semantik untuk satu atau lebih kategori/ruang nama yang kemudian dapat dipantau perubahannya',
	'right-semanticwatch' => 'Menggunakan daftar pantauan semantik',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Mengubah]] kelompok daftar pantauan semantik',
	'special-semanticwatchlist' => 'Daftar Pantau Semantik',
	'special-watchlistconditions' => 'Kriteria daftar pantau semantik',
	'swl-group-name' => 'Nama kelompok:',
	'swl-group-properties' => 'Properti yang dicakup oleh kelompok ini:',
	'swl-group-remove-property' => 'Hapus properti',
	'swl-group-page-selection' => 'Halaman dalam',
);

/** Italian (italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'swl-group-name' => 'Nome gruppo:',
	'swl-group-remove-property' => 'Rimuovi proprietà',
	'swl-group-add-property' => 'Aggiungi proprietà',
	'swl-group-save' => 'Salva',
	'swl-group-saved' => 'Salvato',
	'swl-group-saving' => 'Salvataggio',
	'swl-group-delete' => 'Cancella',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'namespace',
	'swl-group-save-all' => 'Salva tutto',
	'swl-group-add-new-group' => 'Aggiungi un nuovo gruppo',
	'swl-group-add-group' => 'Aggiungi gruppo',
	'swl-watchlist-insertions' => 'Nuovo:',
	'swl-watchlist-deletions' => 'Vecchio:',
	'swl-watchlist-pagincontrol' => 'Vedi ($1) ($2)',
	'swl-watchlist-firstn' => 'primo $1',
	'swl-watchlist-firstn-title' => 'Primi $1 {{PLURAL:$1|risultato|risultati}}',
	'prefs-swlglobal' => 'Opzioni generali',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|proprietà|proprietà}} $3 dalla categoria ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|proprietà|proprietà}} $3 dal namespace ''$4''",
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Shirayuki
 */
$messages['ja'] = array(
	'semanticwatchlist-desc' => 'Semantic MediaWiki のデータの変更を利用者に通知できるようにする',
	'right-semanticwatch' => '意味的ウォッチリストを使用',
	'right-semanticwatchgroups' => '意味的ウォッチリストのグループを[[Special:WatchlistConditions|変更]]',
	'special-semanticwatchlist' => '意味的ウォッチリスト',
	'special-watchlistconditions' => '意味的ウォッチリストの条件',
	'group-swladmins' => '意味的ウォッチリスト管理者',
	'group-swladmins-member' => '{{GENDER:$1|意味的ウォッチリスト管理者}}',
	'grouppage-swladmins' => '{{ns:project}}:意味的ウォッチリスト管理者',
	'swl-group-name' => 'グループ名：',
	'swl-group-properties' => 'このグループが対応するプロパティ:',
	'swl-group-remove-property' => 'プロパティを除去',
	'swl-group-add-property' => 'プロパティを追加',
	'swl-group-save' => '保存',
	'swl-group-saved' => '保存済み',
	'swl-group-saving' => '保存中',
	'swl-group-delete' => '削除',
	'swl-group-category' => 'カテゴリ',
	'swl-group-namespace' => '名前空間',
	'swl-group-concept' => '概念',
	'swl-group-confirmdelete' => 'ウォッチリストグループ「$1」を本当に削除しますか？',
	'swl-group-save-all' => 'すべて保存',
	'swl-group-add-new-group' => '新規グループを追加',
	'swl-group-add-group' => 'グループを追加',
	'swl-watchlist-insertions' => '新:',
	'swl-watchlist-deletions' => '旧:',
	'swl-watchlist-pagincontrol' => '表示 ($1) ($2)',
	'swl-watchlist-no-items' => '意味的ウォッチリストには何も項目がありません。',
	'swl-watchlist-can-mod-groups' => '[[$1|ウォッチリストグループを修正]]できます。',
	'swl-watchlist-can-mod-prefs' => '[[$1|ウォッチリストグループを修正]]できます。ウォッチするプロパティの設定を含みます。',
	'swl-email-propschanged' => 'プロパティは$1に変更されました',
	'swl-email-changes' => '[$2 $1]のプロパティの変更:',
	'prefs-swl' => '意味的ウォッチリスト',
	'prefs-swlgroup' => 'ウォッチするグループ',
	'prefs-swlglobal' => '全般オプション',
	'swl-prefs-emailnofity' => 'ウォッチしているプロパティが変更されたらメールで知らせる',
	'swl-prefs-watchlisttoplink' => '意味的ウォッチリストへのリンクをページの上部に表示',
	'swl-err-userid-xor-groupids' => '利用者 ID またはグループ ID の片方のみを指定する必要があります。',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'special-semanticwatchlist' => 'სემანტიკური კონტროლის სია',
	'group-swladmins' => 'სემანტიკური კონტროლის სიის ადმინისტრატორები',
	'group-swladmins-member' => '{{GENDER:$1|სემანტიკური კონტროლის სიის ადმინისტრატორი}}',
	'grouppage-swladmins' => '{{ns:project}}:სემანტიკური კონტროლის სიის ადმინისტრატორები',
	'swl-group-name' => 'ჯგუფის სახელი:',
	'swl-group-save' => 'შენახვა',
	'swl-group-saved' => 'შენახულია',
	'swl-group-saving' => 'ინახება',
	'swl-group-delete' => 'წაშლა',
	'swl-group-category' => 'კატეგორია',
	'swl-group-namespace' => 'სახელთა სივრცე',
	'swl-group-save-all' => 'ყველას შენახვა',
	'swl-group-add-new-group' => 'ახალი ჯგუფის დამატება',
	'swl-group-add-group' => 'ჯგუფის დამატება',
	'swl-watchlist-insertions' => 'ახალი:',
	'swl-watchlist-deletions' => 'ძველი:',
	'swl-watchlist-pagincontrol' => 'ხილვა ($1) ($2)',
	'swl-watchlist-firstn' => 'პირველი $1',
	'swl-watchlist-firstn-title' => 'პირველი $1 {{PLURAL:$1|შედეგი|შედეგი}}',
);

/** Kannada (ಕನ್ನಡ)
 * @author Nayvik
 */
$messages['kn'] = array(
	'swl-watchlist-insertions' => 'ಹೊಸ:',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'group-swladmins' => '시맨틱 주시문서 목록 관리자',
	'group-swladmins-member' => '{{GENDER:$1|시맨틱 주시문서 목록 관리자}}',
	'grouppage-swladmins' => '{{ns:project}}:시맨틱 주시문서 목록 관리자',
	'group-swladmins.css' => '/* 이 CSS 설정은 시맨틱 주시문서 목록 관리자에만 적용됩니다 */',
	'group-swladmins.js' => '/* 이 자바스크립트 설정은 시맨틱 주시문서 목록 관리자에만 적용됩니다 */',
	'swl-group-save' => '저장',
	'swl-group-saved' => '저장됨',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'semanticwatchlist-desc' => 'Määt et müjjelesch, Jroppe vun semantesche Eijeschaffte aanzjävve, för Saachjroppe un Appachtemangs, di dann op en Oppaßleß kumme un bewach wääde, för der Fall, dat se jeändert wääde.',
	'right-semanticwatch' => 'De semantesche Oppaßleß verwände',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Jroppe ändere]] för de semantesche Oppaßleßte',
	'special-semanticwatchlist' => 'Semantesch Oppaßleß',
	'special-watchlistconditions' => 'Enshtällonge för de semantesche Oppaßleßte',
);

/** Kurdish (Latin script) (‪Kurdî (latînî)‬)
 * @author George Animal
 */
$messages['ku-latn'] = array(
	'swl-group-save' => 'Tomar bike',
	'swl-group-category' => 'kategorî',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'right-semanticwatch' => 'Semantesch Iwwerwaachungslëscht benotzen',
	'special-semanticwatchlist' => 'Semantesch Iwwerwaachungslëscht',
	'special-watchlistconditions' => 'Astellunge vun der semantescher Iwwerwaachnugslëscht',
	'group-swladmins' => 'SWL-Administrateuren',
	'group-swladmins-member' => '{{GENDER:$1|SWL-Administrateur|SWL-Administratrice}}',
	'grouppage-swladmins' => '{{ns:project}}:SWL-Administrateuren',
	'swl-group-name' => 'Numm vum Grupp:',
	'swl-group-page-selection' => 'Säiten a(n)',
	'swl-group-save' => 'Späicheren',
	'swl-group-saved' => 'Gespäichert',
	'swl-group-saving' => 'Späicheren',
	'swl-group-delete' => 'Läschen',
	'swl-group-category' => 'Kategorie',
	'swl-group-namespace' => 'Nummraum',
	'swl-group-concept' => 'Konzept',
	'swl-group-confirmdelete' => 'Sidd Dir sécher datt Dir de Grupp vun der Iwwerwaachungslëscht "$1" läsche wëllt?',
	'swl-group-save-all' => 'All späicheren',
	'swl-group-add-new-group' => 'Eng nei Grupp derbäisetzen',
	'swl-group-add-group' => 'Grupp derbäisetzen',
	'swl-watchlist-insertions' => 'Derbäigesat:',
	'swl-watchlist-deletions' => 'Al:',
	'swl-watchlist-pagincontrol' => '($1) ($2) weisen',
	'swl-watchlist-firstn' => 'éischt $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Dat éischt Resultat|Déi éischt $1 Resultater}}',
	'swl-watchlist-no-items' => 'Dir hutt keng Objeten op Ärer Iwwerwaachungslëscht.',
	'swl-watchlist-can-mod-groups' => "Dir kënnt [[$1|d'Gruppe vun der Iwwerwaachungslëscht änneren]].",
	'swl-email-propschanged' => "D'Eegeschafte goufen op $1 geännert",
	'prefs-swl' => 'Semantesch Iwwerwaachungslëscht',
	'prefs-swlgroup' => "Gruppe fir z'iwwerwaachen",
	'prefs-swlglobal' => 'Allgemeng Optiounen',
	'swl-prefs-emailnofity' => 'Mir eng Mail schécke wann Attributer déi ech iwwerwaachen geännert ginn',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'semanticwatchlist-desc' => 'Овозможува известување на корисниците за одредени измени во податоците на Семантички МедијаВики',
	'right-semanticwatch' => 'Користење на семантички список на набљудувања',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Менување]] на групи од семантички списоци на набљудувања',
	'special-semanticwatchlist' => 'Семантички список на набљудувања',
	'special-watchlistconditions' => 'Услови за семантичкиот список на набљудувања',
	'group-swladmins' => 'Администратори на Семантичкиот список на набљудувања',
	'group-swladmins-member' => '{{GENDER:$1|администратор на Семантичкиот список на набљудувања}}',
	'grouppage-swladmins' => '{{ns:project}}:Админи_на_Семантичкиот_список_на_набљудувања',
	'group-swladmins.css' => '/* Тука поставениот CSS ќе се применува само врз администраторите на семантички список на набљудувања */',
	'group-swladmins.js' => '/* Тука поставениот JS ќе се применува само врз администраторите на семантички список на набљудувања */',
	'swl-group-name' => 'Име на групата:',
	'swl-group-properties' => 'Својства покриени со оваа група:',
	'swl-group-remove-property' => 'Отстрани својство',
	'swl-group-add-property' => 'Додај својство',
	'swl-group-page-selection' => 'Страници во',
	'swl-group-save' => 'Зачувај',
	'swl-group-saved' => 'Зачувано',
	'swl-group-saving' => 'Зачувувам',
	'swl-group-delete' => 'Избриши',
	'swl-group-category' => 'категорија',
	'swl-group-namespace' => 'именски простор',
	'swl-group-concept' => 'концепт',
	'swl-group-confirmdelete' => 'Дали сте сигурни дека сакате да ја избришете групата „$1“ од списокот на набљудувања?',
	'swl-group-save-all' => 'Зачувај сè',
	'swl-group-add-new-group' => 'Додај нова група',
	'swl-group-add-group' => 'Додај група',
	'swl-watchlist-position' => "Приказ на '''$1''' од последните промени, почнувајќи од '''бр. $2'''.",
	'swl-watchlist-insertions' => 'Додадено:',
	'swl-watchlist-deletions' => 'Стари:',
	'swl-watchlist-pagincontrol' => 'Видете ($1) ($2)',
	'swl-watchlist-firstn' => 'први $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Прв $1 резултат|Први $1 резултати}}',
	'swl-watchlist-no-items' => 'Немате ништо во списокот на набљудувања.',
	'swl-watchlist-can-mod-groups' => 'Можете да ги [[$1|измените групите на набљудувања]].',
	'swl-watchlist-can-mod-prefs' => 'Можете да ги [[$1|измените вашите нагодувања за набљудување]]., вклучувајќи кои својства да се набљудуваат.',
	'swl-watchlist-no-groups' => 'Сè уште не набљудувате ниедна група со списоци на набљудувања. [[$1|Измени нагодувања]].',
	'swl-email-propschanged' => 'Својствата на $1 се имаат изменето',
	'swl-email-propschanged-long' => "Едно или повеќе својства на '''$1''' што ги набљудувате се изменети од корисникот '''$2''' на $4 во $5 ч.. Можете да ги погледате овие и други промени на [$3 вашиот семантички список на набљудувања].",
	'swl-email-changes' => 'Измени во својства на [$2 $1]:',
	'prefs-swl' => 'Семантички список на набљудувања',
	'prefs-swlgroup' => 'Групи за набљудување',
	'prefs-swlglobal' => 'Општи наагодувања',
	'swl-prefs-emailnofity' => 'Испрати ми е-пошта кога ќе се изменат својствата што ги набљудувам',
	'swl-prefs-watchlisttoplink' => 'Прикажувај врска до Семантичкиот список на набљудувања најгоре на страницата',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|својство|својства}} $3 од категоријата ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|својство|својства}} $3 од именскиот простор ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|својство|својства}} $3 од концептот ''$4''",
	'swl-err-userid-xor-groupids' => 'Треба да ја наведете назнаката на корисникот или назнаките на групата (но не обете).',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'semanticwatchlist-desc' => 'Membolehkan penenetuan kumpulan-kumpulan sifat semantik untuk satu atau lebih kategori/ruang nama yang kemudiannya boleh dipantau untuk perubahan',
	'right-semanticwatch' => 'Menggunakan senarai pantau semantik',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Mengubah suai]] kumpulan senarai pantau semantik',
	'special-semanticwatchlist' => 'Senarai Pantau Semantik',
	'special-watchlistconditions' => 'Syarat-syarat senarai pantau semantik',
);

/** Maltese (Malti)
 * @author Chrisportelli
 */
$messages['mt'] = array(
	'swl-group-delete' => 'Ħassar',
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'spazju tal-isem',
	'swl-group-concept' => 'kunċett',
	'swl-group-save-all' => 'Salva kollox',
	'swl-group-add-new-group' => 'Żid grupp ġdid',
	'swl-group-add-group' => 'Żid grupp',
	'swl-watchlist-insertions' => 'Ġdid:',
	'swl-watchlist-deletions' => 'Qadim:',
);

/** Norwegian Bokmål (‪norsk (bokmål)‬)
 * @author Event
 */
$messages['nb'] = array(
	'semanticwatchlist-desc' => 'Lar brukere bli informert om spesifikke endringer i Semantic MediaWiki-data.',
	'right-semanticwatch' => 'Bruk semantisk overvåkningsliste',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Endre]] gruppene for semantiske overvåkningslister',
	'special-semanticwatchlist' => 'Semantisk overvåkningsliste',
	'special-watchlistconditions' => 'Betingelser for semantisk overvåkningsliste',
	'group-swladmins' => 'Administratorer av semantisk overvåkningsliste',
	'group-swladmins-member' => '{{GENDER:$1|Administrator av semantisk overvåkningsliste}}',
	'grouppage-swladmins' => '{{ns:project}}:Administratorer av semantisk overvåkningsliste',
	'swl-group-name' => 'Gruppenavn:',
	'swl-group-properties' => 'Egenskaper dekket av denne gruppen:',
	'swl-group-remove-property' => 'Fjern egenskap',
	'swl-group-add-property' => 'Legg til egenskap',
	'swl-group-page-selection' => 'Sider i',
	'swl-group-save' => 'Lagre',
	'swl-group-saved' => 'Lagret',
	'swl-group-saving' => 'Lagrer',
	'swl-group-delete' => 'Slett',
	'swl-group-category' => 'kategori',
	'swl-group-namespace' => 'navnerom',
	'swl-group-concept' => 'begrep',
	'swl-group-confirmdelete' => 'Er du sikker på at du vil slette overvåkningslistegruppe "$1"?',
	'swl-group-save-all' => 'Lagre alle/alt',
	'swl-group-add-new-group' => 'Legg til ny gruppe',
	'swl-group-add-group' => 'Legg til gruppe',
	'swl-watchlist-position' => "Viser '''$1''' av {{PLURAL:$1|den siste endringen|de siste endringene}} som begynner med '''#$2'''.",
	'swl-watchlist-insertions' => 'Ny:',
	'swl-watchlist-deletions' => 'Gammel:',
	'swl-watchlist-pagincontrol' => 'Vis ($1) ($2)',
	'swl-watchlist-firstn' => 'første $1',
	'swl-watchlist-firstn-title' => 'Første {{PLURAL:$1|resultat|$1 resultater}}',
	'swl-watchlist-no-items' => 'Du har ingen elementer på din semantiske overvåkningsliste.',
	'swl-watchlist-can-mod-groups' => 'Du kan [[$1|endre gruppene for overvåkningslister]].',
	'swl-watchlist-can-mod-prefs' => 'Du kan [[$1|endre dine innstillinger for overvåkningslister]], herunder å velge hvilken egenskaper som skal overvåkes.',
	'swl-watchlist-no-groups' => 'Du har ikke aktivisert noen grupper av overvåkningslister. [[$1|Endre dine innstillinger for overvåkningslister]].',
	'swl-email-propschanged' => 'Egenskaper er endret på $1',
	'swl-email-propschanged-long' => "En eller flere egenskaper du overvåker på '''$1'' har blitt endret av bruker '''$2''' på $4 den $5. Du kan se på disse og andre endringer på [$3 din semantiske overvåkningsliste]",
	'swl-email-changes' => 'Egenskapsendringer på [$2 $1]:',
	'prefs-swl' => 'Semantisk overvåkningsliste',
	'prefs-swlgroup' => 'Grupper å overvåke',
	'prefs-swlglobal' => 'Generelle valg',
	'swl-prefs-emailnofity' => 'Send meg e-post om endringer av egenskaper jeg overvåker',
	'swl-prefs-watchlisttoplink' => 'Vis en lenke til den semantiske overvåkningslisten på toppen av siden',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 fra kategori ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 fra navnerom ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 fra begrep ''$4''",
	'swl-err-userid-xor-groupids' => 'Enten må parameter for bruker-id eller gruppe-id-er angis, men ikke begge.',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'semanticwatchlist-desc' => 'Laat gebruikers een volglijst samenstellen op basis van wijzigingen in gegevens van Semantic MediaWiki',
	'right-semanticwatch' => 'Semantische volglijst gebruiken',
	'right-semanticwatchgroups' => 'De semantische volglijstgroepen [[Special:WatchlistConditions|aanpassen]]',
	'special-semanticwatchlist' => 'Semantische volglijst',
	'special-watchlistconditions' => 'Voorwaarden voor semantische volglijst',
	'group-swladmins' => 'Beheerders semantische volglijst',
	'group-swladmins-member' => '{{GENDER:$1|beheerder semantische volglijst}}',
	'grouppage-swladmins' => '{{ns:project}}:Beheerders semantische volglijst',
	'swl-group-name' => 'Groepsnaam:',
	'swl-group-properties' => 'Eigenschappen die onder deze groep vallen:',
	'swl-group-remove-property' => 'Eigenschap verwijderen',
	'swl-group-add-property' => 'Eigenschap toevoegen',
	'swl-group-page-selection' => "Pagina's in",
	'swl-group-save' => 'Opslaan',
	'swl-group-saved' => 'Opgeslagen',
	'swl-group-saving' => 'Bezig met opslaan',
	'swl-group-delete' => 'Verwijderen',
	'swl-group-category' => 'categorie',
	'swl-group-namespace' => 'naamruimte',
	'swl-group-concept' => 'concept',
	'swl-group-confirmdelete' => 'Weet u zeker dat u de volglijstgroep "$1" wilt verwijderen?',
	'swl-group-save-all' => 'Allemaal opslaan',
	'swl-group-add-new-group' => 'Een nieuwe groep toevoegen',
	'swl-group-add-group' => 'Groep toevoegen',
	'swl-watchlist-position' => "Resultaat '''$1''' van de laatste wijzigingen beginnend met '''#$2'''.",
	'swl-watchlist-insertions' => 'Toegevoegd:',
	'swl-watchlist-deletions' => 'Oud:',
	'swl-watchlist-pagincontrol' => 'Bekijken ($1) ($2)',
	'swl-watchlist-firstn' => 'eerste $1',
	'swl-watchlist-firstn-title' => 'Eerste $1 {{PLURAL:$1|resultaat|resultaten}}',
	'swl-watchlist-no-items' => 'Uw semantische volglijst is leeg.',
	'swl-watchlist-can-mod-groups' => 'U kunt de [[$1|volglijstgroepen aanpassen]].',
	'swl-watchlist-can-mod-prefs' => 'U kunt [[$1|uw volglijstwijzigingen aanpassen]], inclusief welke eigenschappen gevolgd moeten worden.',
	'swl-watchlist-no-groups' => 'U volgt nog geen volglijstgroepen. U kunt [[$1|uw volglijstinstellingen aanpassen]].',
	'swl-email-propschanged' => 'Eigenschappen zijn veranderd op $1',
	'swl-email-propschanged-long' => "Een of meer eigenschappen die u volgt op '''$1''' zijn gewijzigd door gebruiker '''$2''' om $4 op $5. U kunt deze en andere wijzigingen bekijken op [$3 uw semantische volglijst].",
	'swl-email-changes' => 'Wijzigingen in eigenschappen op [$2 $1]:',
	'prefs-swl' => 'Semantische Volglijst',
	'prefs-swlgroup' => 'Te volgen groepen',
	'prefs-swlglobal' => 'Algemene opties',
	'swl-prefs-emailnofity' => 'Mij e-mailen bij wijzigingen in eigenschappen die ik volg',
	'swl-prefs-watchlisttoplink' => 'Bovenaan de pagina een verwijzing weergeven naar de semantische volglijst',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|eigenschap|eigenschappen}} $3 van categorie ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|eigenschap|eigenschappen}} $3 van naamruimte ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|eigenschap|eigenschappen}} $3 van concept ''$4''",
	'swl-err-userid-xor-groupids' => 'Geef de parameter "userid" of "groupids" op, maar niet beide.',
);

/** Deitsch (Deitsch)
 * @author Xqt
 */
$messages['pdc'] = array(
	'swl-group-save' => 'Beilege',
	'swl-group-saved' => 'Bhalde',
	'swl-group-delete' => 'Verwische',
);

/** Pälzisch (Pälzisch)
 * @author Manuae
 */
$messages['pfl'] = array(
	'swl-group-save' => 'Schbaischere',
	'swl-group-saved' => 'Gschbaischad',
	'swl-group-delete' => 'Lesche',
	'swl-watchlist-pagincontrol' => 'Zaisch ($1) ($2)',
	'swl-watchlist-no-items' => 'Du dudschd nix beobachde.',
);

/** Portuguese (português)
 * @author Giro720
 * @author Hamilton Abreu
 */
$messages['pt'] = array(
	'semanticwatchlist-desc' => 'Permite que os utilizadores sejam notificados de alterações específicas aos dados do MediaWiki Semântico',
	'right-semanticwatch' => 'Usar a lista de propriedades semânticas vigiadas',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Alterar]] os grupos de propriedades semânticas vigiadas',
	'special-semanticwatchlist' => 'Lista das Propriedades Semânticas Vigiadas',
	'special-watchlistconditions' => 'Condições da lista das propriedades semânticas vigiadas',
	'group-swladmins' => 'Administradores das Propriedades Semânticas Vigiadas',
	'group-swladmins-member' => '{{GENDER:$1|Administrador das Propriedades Semânticas Vigiadas|Administradora das Propriedades Semânticas Vigiadas}}',
	'grouppage-swladmins' => '{{ns:project}}:Administradores_das_Propriedades_Semânticas_Vigiadas',
	'swl-group-name' => 'Nome de grupo:',
	'swl-group-properties' => 'Propriedades abrangidas por este grupo:',
	'swl-group-remove-property' => 'Remover propriedade',
	'swl-group-add-property' => 'Adicionar propriedade',
	'swl-group-page-selection' => 'Páginas em',
	'swl-group-save' => 'Gravar',
	'swl-group-saved' => 'Gravado',
	'swl-group-saving' => 'A gravar',
	'swl-group-delete' => 'Eliminar',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'espaço nominal',
	'swl-group-concept' => 'conceito',
	'swl-group-confirmdelete' => 'Tem a certeza de que pretende eliminar o grupo de propriedades semântica vigiadas "$1"?',
	'swl-group-save-all' => 'Gravar todos',
	'swl-group-add-new-group' => 'Adicionar um grupo novo',
	'swl-group-add-group' => 'Adicionar grupo',
	'swl-watchlist-position' => "A mostrar '''$1''' das últimas alterações, começando pela '''$2ª'''.",
	'swl-watchlist-insertions' => 'Adições:',
	'swl-watchlist-deletions' => 'Antigas:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => 'primeiras $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Primeiro resultado|Primeiros $1 results}}',
	'swl-watchlist-no-items' => 'A sua lista de propriedades semânticas vigiadas está vazia.',
	'swl-watchlist-can-mod-groups' => 'Pode [[$1|alterar os grupos de propriedades semânticas vigiadas]].',
	'swl-watchlist-can-mod-prefs' => 'Pode [[$1|alterar as suas preferências das propriedades semânticas vigiadas]], incluindo definir quais as propriedades que pretende vigiar.',
	'swl-watchlist-no-groups' => 'Ainda não está a vigiar nenhum grupo de propriedades semânticas vigiadas. [[$1|Alterar as suas preferências das propriedades semânticas vigiadas]].',
	'swl-email-propschanged' => 'Propriedades alteradas na $1',
	'swl-email-propschanged-long' => "Uma ou mais propriedades que está a vigiar na '''$1''' foram alteradas pelo utilizador '''$2''' às $4 de $5. Pode ver estas e outras alterações  na sua [$3 lista de propriedades semânticas vigiadas].",
	'swl-email-changes' => 'Alterações de propriedades em [$2 $1]:',
	'prefs-swl' => 'Lista das propriedades semânticas vigiadas',
	'prefs-swlgroup' => 'Grupos para vigiar',
	'prefs-swlglobal' => 'Opções gerais',
	'swl-prefs-emailnofity' => 'Notificar-me por correio electrónico das alterações de propriedades que estou a vigiar',
	'swl-prefs-watchlisttoplink' => 'Mostrar um link para a lista de propriedades semânticas vigiadas no topo da página',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|Propriedade|Propriedades}} $3 da categoria ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|Propriedade|Propriedades}} $3 do espaço nominal ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|propriedade|propriedades}} $3 do conceito ''$4''",
	'swl-err-userid-xor-groupids' => 'Deve ser especificado, ou o parâmetro de identificação do utilizador, ou o parâmetro de identificações de grupos, mas não ambos.',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'swl-group-name' => 'කාණ්ඩ නාමය:',
	'swl-group-save' => 'සුරකින්න',
	'swl-group-saved' => 'සුරකින ලදී',
	'swl-group-saving' => 'සුරකිමින්',
	'swl-group-delete' => 'මකන්න',
	'swl-group-category' => 'ප්‍රවර්ගය',
	'swl-group-namespace' => 'නාමඅවකාශය',
	'swl-group-save-all' => 'සියල්ල සුරකින්න',
	'swl-watchlist-insertions' => 'නව:',
	'swl-watchlist-deletions' => 'පැරණි:',
	'swl-watchlist-pagincontrol' => 'නරඹන්න ($1) ($2)',
	'prefs-swlglobal' => 'ප්‍රධාන විකල්පයන්',
);

/** Somali (Soomaaliga)
 * @author Maax
 */
$messages['so'] = array(
	'swl-group-category' => 'qeyb',
);

/** Tamil (தமிழ்)
 * @author Karthi.dr
 * @author Shanmugamp7
 */
$messages['ta'] = array(
	'swl-group-name' => 'குழுப் பெயர்:',
	'swl-group-properties' => 'இந்தக் குழுவின் கீழ் உள்ள உடமைகள்:',
	'swl-group-remove-property' => 'உடமையை நீக்கு',
	'swl-group-add-property' => 'உடமையைச் சேர்',
	'swl-group-save' => 'சேமி',
	'swl-group-saved' => 'சேமிக்கப்பட்டது',
	'swl-group-saving' => 'சேமிக்கப்படுகிறது',
	'swl-group-delete' => 'நீக்கு',
	'swl-group-category' => 'பகுப்பு',
	'swl-group-namespace' => 'பெயர்வெளி',
	'swl-group-concept' => 'கோட்பாடு',
	'swl-group-confirmdelete' => '"$1" கவனிப்பு பட்டியல் குழுவை உறுதியாக நீக்க விரும்புகிறீர்களா?',
	'swl-group-save-all' => 'அனைத்தையும் சேமி',
	'swl-group-add-new-group' => 'ஒரு புதிய குழுவைச் சேர்',
	'swl-group-add-group' => 'குழுவைச் சேர்',
	'swl-watchlist-insertions' => 'புதிய:',
	'swl-watchlist-deletions' => 'பழைய:',
	'swl-watchlist-pagincontrol' => 'பார்வையிடு ($1) ($2)',
	'swl-watchlist-firstn' => 'முதல்  $1',
	'prefs-swlglobal' => 'பொதுவான விருப்பத் தேர்வுகள்',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'swl-group-save' => 'భద్రపరచు',
	'swl-group-delete' => 'తొలగించు',
	'swl-group-category' => 'వర్గం',
	'swl-group-namespace' => 'పేరుబరి',
	'swl-watchlist-insertions' => 'కొత్త:',
	'swl-watchlist-deletions' => 'పాతవి:',
	'swl-watchlist-firstn-title' => 'మొదటి $1 {{PLURAL:$1|ఫలితం|ఫలితాలు}}',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'semanticwatchlist-desc' => 'Nagpapahintulot na maipabatid sa mga tagagamit ang partikular na mga pagbabago sa dato ng Semantikong MediaWiki',
	'right-semanticwatch' => 'Gamitin ang semantikong talaan ng binabantayan',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Baguhin]] ang semantikong mga pangkat ng talaan ng binabantayan',
	'special-semanticwatchlist' => 'Semantikong Talaan ng Binabantayan',
	'special-watchlistconditions' => 'Mga kalagayan ng semantikong talaan ng binabantayan',
	'group-swladmins' => 'Mga tagapangasiwa ng Semantikong Listahan ng mga Binabantayan',
	'group-swladmins-member' => '{{GENDER:$1|Tagapangasiwa ng Semantikong Talaan ng mga Binabantayan}}',
	'grouppage-swladmins' => '{{ns:project}}:Mga tagapangasiwa ng Semantikong Talaan ng mga Binabantayan',
	'group-swladmins.css' => '/* Ang Mga Pilas ng Estilong Lumalagaslas (Cascading Style Sheets o CSS) na inilagay dito ay makakaapekto lamang sa mga tagapangasiwa ng Semantikong tala ng mga binabantayan */',
	'group-swladmins.js' => '/* Ang JavaScript o JS na inilagay dito ay makakaapekto lamang sa mga tagapangasiwa ng Semantikong tala ng mga binabantayan */',
	'swl-group-name' => 'Pangalan ng pangkat:',
	'swl-group-properties' => 'Mga pag-aari na nasasakop ng pangkat na ito:',
	'swl-group-remove-property' => 'Tanggalin ang pag-aari',
	'swl-group-add-property' => 'Idagdag ang kaarian',
	'swl-group-page-selection' => 'Mga pahina sa loob ng',
	'swl-group-save' => 'Sagipin',
	'swl-group-saved' => 'Nasagip na',
	'swl-group-saving' => 'Sinasagip',
	'swl-group-delete' => 'Burahin',
	'swl-group-category' => 'kategorya',
	'swl-group-namespace' => 'puwang ng pangalan',
	'swl-group-concept' => 'diwa',
	'swl-group-confirmdelete' => 'Nakatitiyak ka bang nais mong burahin ang pangkat ng listahan ng mga binabantayan na "$1"?',
	'swl-group-save-all' => 'Sagipin ang lahat',
	'swl-group-add-new-group' => 'Magdagdag ng isang bagong pangkat',
	'swl-group-add-group' => 'Idagdag ang pangkat',
	'swl-watchlist-position' => "Ipinapakita ang '''$1''' ng huling {{PLURAL:$1|pagbabago|mga pagbabago}} na nag-uumpisa sa '''#$2'''.",
	'swl-watchlist-insertions' => 'Bago:',
	'swl-watchlist-deletions' => 'Luma:',
	'swl-watchlist-pagincontrol' => 'Tingnan ($1) ($2)',
	'swl-watchlist-firstn' => 'unang $1',
	'swl-watchlist-firstn-title' => 'Unang $1 {{PLURAL:$1|resulta|mga resulta}}',
	'swl-watchlist-no-items' => 'Walang kang mga bagay sa ibabaw ng iyong semantikong listahan ng mga binabantayan.',
	'swl-watchlist-can-mod-groups' => 'Maaari mong [[$1|baguhin ang mga pangkat ng listahan ng mga binabantayan]].',
	'swl-watchlist-can-mod-prefs' => 'Maaari mong [[$1|baguhin ang iyong mga kanaisan sa listahan ng mga binabantayan]], kabilang na ang pagtatakda ng kung aling mga pag-aari ang babantayan.',
	'swl-watchlist-no-groups' => 'Hindi ka pa nagbabantay ng anumang mga pangkat ng mga binabantayan. [[$1|Baguhin ang iyong mga kanaisan sa listahan ng mga binabantayan]].',
	'swl-email-propschanged' => 'Nagbago ang mga pag-aari roon sa $1',
	'swl-email-propschanged-long' => "Binago ng tagagamit na si '''$2''' sa ganap na $4 noong $5 ang isa o mas mahigit pang mga pag-aaring binabantayan mo roon sa '''$1'''. Matitingnan mo ang mga ito at iba pang mga pagbabago roon sa [$3 iyong semantikong listahan ng mga binabantayan].",
	'swl-email-changes' => 'Mga pagbabago sa kaarian sa [$2 $1]:',
	'prefs-swl' => 'Semantikong listahan ng mga binabantayan',
	'prefs-swlgroup' => 'Babantayang mga pangkat',
	'prefs-swlglobal' => 'Pangkalahatang mga mapagpipilian',
	'swl-prefs-emailnofity' => 'Padalhan ako ng elektronikong liham hinggil sa mga pagbabago sa mga pag-aaari na binabantayan ko',
	'swl-prefs-watchlisttoplink' => 'Magpakita ng isang kawing sa Semantikong Listahan ng mga Binabantayan sa itaas ng pahina',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|pag-aari|mga pag-aari}} $3 mula sa kategoryang ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|pag-aari|mga pag-aari}} $3 mula sa puwang ng pangalan na ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|pag-aari|mga pag-aari}} $3 mula sa diwang ''$4''",
	'swl-err-userid-xor-groupids' => 'Dapat na tukuyin ang parametro ng ID ng tagagamit o mga ID ng pangkat, subalit hindi ang dalawang mga ito.',
);

/** Urdu (اردو)
 * @author පසිඳු කාවින්ද
 */
$messages['ur'] = array(
	'swl-group-save' => 'محفوظ کریں',
	'swl-group-saved' => 'محفوظ کر لیا',
	'swl-group-saving' => 'بچت',
	'swl-group-delete' => 'حذف کریں',
	'swl-group-category' => 'زمرہ',
	'swl-group-namespace' => 'نیم سپیس',
	'swl-group-save-all' => 'سب کو محفوظ کریں',
	'swl-group-add-group' => 'گروپ میں شامل',
	'swl-watchlist-insertions' => 'نیا:',
	'swl-watchlist-deletions' => 'عمر:',
);

/** Vietnamese (Tiếng Việt)
 * @author පසිඳු කාවින්ද
 */
$messages['vi'] = array(
	'swl-group-save' => 'Lưu',
	'swl-group-saved' => 'Đã lưu',
	'swl-group-saving' => 'Đang lưu',
	'swl-group-delete' => 'Xóa',
	'swl-group-category' => 'thể loại',
	'swl-group-namespace' => 'không gian tên',
	'swl-group-save-all' => 'Lưu tất cả',
);

/** Yiddish (ייִדיש)
 * @author פוילישער
 * @author පසිඳු කාවින්ද
 */
$messages['yi'] = array(
	'swl-group-save' => 'אויפֿהיטן',
	'swl-group-delete' => 'אויסמעקן',
	'swl-group-category' => 'קאַטעגאריע',
	'swl-watchlist-firstn' => 'ערשטער $1',
);

/** Simplified Chinese (‪中文（简体）‬)
 * @author Linforest
 */
$messages['zh-hans'] = array(
	'semanticwatchlist-desc' => '让用户获得关于Semantic MediaWiki数据特定更改的通知',
	'right-semanticwatch' => '使用语义监视列表',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|修改]]语义监视列表组',
	'special-semanticwatchlist' => '语义监视列表',
	'special-watchlistconditions' => '语义监视列表条件',
	'group-swladmins' => '语义监视列表管理员',
	'group-swladmins-member' => '{{GENDER:$1|语义监视列表管理员}}',
	'grouppage-swladmins' => '{{ns:project}}:语义监视列表管理员',
	'swl-group-name' => '组名：',
	'swl-group-properties' => '该组所涵盖的属性：',
	'swl-group-remove-property' => '删除属性',
	'swl-group-add-property' => '添加属性',
	'swl-group-page-selection' => '中的页面',
	'swl-group-save' => '保存',
	'swl-group-saved' => '已保存',
	'swl-group-saving' => '正在保存……',
	'swl-group-delete' => '删除',
	'swl-group-category' => '类别',
	'swl-group-namespace' => '命名空间',
	'swl-group-concept' => '概念',
	'swl-group-confirmdelete' => '您确实要删除"$1"监视列表组吗？',
	'swl-group-save-all' => '全部保存',
	'swl-group-add-new-group' => '添加新的组',
	'swl-group-add-group' => '添加组',
	'swl-watchlist-position' => "显示从'''#$2'''开始的，最后{{PLURAL:$1|变更|变更}}的'''$1'''。",
	'swl-watchlist-insertions' => '新：',
	'swl-watchlist-deletions' => '旧：',
	'swl-watchlist-pagincontrol' => '查看 ($1) ($2)',
	'swl-watchlist-firstn' => '前$1',
	'swl-watchlist-firstn-title' => '前$1{{PLURAL:$1|项结果|项结果}}',
	'swl-watchlist-no-items' => '您的监视列表为空。',
	'swl-watchlist-can-mod-groups' => '您可以[[$1|修改监视列表组]]。',
	'swl-watchlist-can-mod-prefs' => '您可以[[$1|监视列表首选项]]，包括设置要监视哪些属性。',
	'swl-watchlist-no-groups' => '您尚未监视任何的监视列表组。[[$1|请修改您的监视列表首选项]]。',
	'swl-email-propschanged' => '位于$1的属性已变更。',
	'swl-email-propschanged-long' => "您在'''$1'''所监视的一个或多个属性已被$5之上位于$4的用户'''$2'''更改。.您可以查看这些变更以及位于[$3 您的语义监视列表]之上的其他变更。",
	'swl-email-changes' => '[$2 $1]之上的属性变更：',
	'prefs-swl' => '语义监视列表',
	'prefs-swlgroup' => '要监视的组',
	'prefs-swlglobal' => '一般选项',
	'swl-prefs-emailnofity' => '电子邮件通知我那些对我所监视属性的变更',
	'swl-prefs-watchlisttoplink' => '在页面顶部显示语义监视列表的链接',
	'swl-prefs-category-label' => "'''$1'''：来自类别''$4''的{{PLURAL:$2|属性|属性}} $3",
	'swl-prefs-namespace-label' => "'''$1'''来自命名空间''$4''的{{PLURAL:$2|属性|属性}} $3",
	'swl-prefs-concept-label' => "'''$1'''：来自概念''$4''的{{PLURAL:$2|属性|属性}} $3",
	'swl-err-userid-xor-groupids' => '需要指定用户ID（userid ）或组ID（groupids ），但不要同时两者都指定。',
);

