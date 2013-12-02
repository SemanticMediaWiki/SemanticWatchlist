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

	// Special:WatchlistConditions
	'swl-group-name' => 'Group name:',
	'swl-group-legend' => 'Group',
	'swl-group-properties' => 'This group watches changes in the property/properties:',
	'swl-properties-list' => 'Separate names with |',
	'swl-group-page-selection' => 'Select pages to watch:',
	'swl-group-save' => 'Save',
	'swl-group-remove' => 'Remove',
	'swl-group-saved' => 'The settings were saved.',
	'swl-group-saving' => 'Saving',
	'swl-group-category' => 'category',
	'swl-group-namespace' => 'namespace',
	'swl-group-concept' => 'concept',
	'swl-group-confirm-remove' => 'Are you sure you want to remove the "$1" watchlist group?',
	'swl-group-add-new-group' => 'Add a new group',
	'swl-group-add-group' => 'Add group',
	'swl-custom-legend' => 'Custom text',
	'swl-custom-remove-property' => 'Remove',
	'swl-custom-text-add' => 'Add custom text',
	'swl-custom-input' => "If the property $1 changes its value to $2, notify users with the following text: $3 ",

	// Special:SemanticWatchlist
	'swl-watchlist-position' => "Showing the last {{PLURAL:$1|change|'''$1''' changes starting with change '''#$2'''}}:",
	'swl-watchlist-insertions' => 'New:',
	'swl-watchlist-deletions' => 'Old:',
	'swl-watchlist-pagincontrol' => 'View ($1) ($2)',
	'swl-watchlist-firstn' => 'first $1',
	'swl-watchlist-firstn-title' => 'First $1 {{PLURAL:$1|result|results}}',
	'swl-watchlist-no-items' => 'You have no items on your semantic watchlist.',
	'swl-watchlist-can-mod-groups' => 'You can [[$1|modify the watchlist groups]].', 
	'swl-watchlist-can-mod-prefs' => 'You can also [[$1|modify your watchlist preferences]], including setting which properties to watch.',
	'swl-watchlist-no-groups' => 'You are not yet watching any watchlist groups. [[$1|Modify your watchlist preferences]].',
	
	// Email
	'swl-email-propschanged' => 'Properties have changed at $1',
	'swl-email-propschanged-long' => "One or more properties you watch at '''$1''' have been changed by {{GENDER:$2|user}} '''$2''' at $4 on $5. You can view these and other changes on [$3 your semantic watchlist].",
	'swl-email-changes' => 'Property changes on [$2 $1]:',

	// Preferences
	'prefs-swl' => 'Semantic watchlist',
	'prefs-swlgroup' => 'Groups to watch',
	'prefs-swlglobal' => 'General options',
	'swl-prefs-emailnofity' => 'Email me on changes to properties I am watching',
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
 * @author Kghbln
 * @author Nemo bis
 * @author Shirayuki
 * @author Siebrand
 * @author Umherirrender
 * @author 아라
 */
$messages['qqq'] = array(
	'semanticwatchlist-desc' => '{{desc|name=Semantic Watchlist|url=https://www.mediawiki.org/wiki/Extension:SemanticWatchlist}}',
	'right-semanticwatch' => '{{doc-right|semanticwatch}}',
	'right-semanticwatchgroups' => '{{doc-right|semanticwatchgroups}}',
	'special-semanticwatchlist' => '{{doc-special|SemanticWatchlist}}',
	'special-watchlistconditions' => '{{doc-special|WatchlistConditions}}',
	'swl-group-name' => 'This is the title of the field that lets you specify the name of a group of properties to be watched on [[Special:SemanticWatchlist]].
{{Identical|Group name}}',
	'swl-group-legend' => 'This is the title of a box on [[Special:WatchlistConditions]] allowing to create a group of properties to be watched on [[Special:SemanticWatchlist]].
{{Identical|Group}}',
	'swl-group-properties' => 'This is the title of the field that lets you specify the properties making up a group of properties to be watched on [[Special:SemanticWatchlist]].',
	'swl-properties-list' => 'This message explains that the names of the properties to be watched by the group should be entered separated by a pipe "|". This is a placeholder text that is displayed in the input field before the user clicks on it.',
	'swl-group-page-selection' => 'This is the title of the field that lets you specify the pages which should be watched by a group on [[Special:SemanticWatchlist]].',
	'swl-group-save' => 'This is the text on the button for saving changes to groups on [[Special:WatchlistConditions]].
{{Identical|Save}}',
	'swl-group-remove' => 'This is the text on the button for removing a group to be watched on [[Special:SemanticWatchlist]].
{{Identical|Remove}}',
	'swl-group-saved' => 'This message indicates that the changes on [[Special:WatchlistConditions]] were processed.',
	'swl-group-saving' => 'This message indicates that the changes on the preferences page are being processed.
{{Identical|Saving}}',
	'swl-group-category' => 'This is an option allowing to select the pages which should be watched by the group. A category holds a group of pages.
{{Identical|Category}}',
	'swl-group-namespace' => 'This is an option allowing to select the pages which should be watched by the group. A namespace holds a group of pages.
{{Identical|Namespace}}',
	'swl-group-concept' => 'This is an option allowing to select the pages which should be watched by the group. A concept holds a group of precomputed pages. A concept may best be described as being a dynamic category.',
	'swl-group-confirm-remove' => 'This message asks for confirmation on [[Special:WatchlistConditions]] if the group should be removed?
* $1 - name of the group',
	'swl-group-add-new-group' => 'This is the text on the button allowing to add a new group of properties to be watched on [[Special:SemanticWatchlist]].',
	'swl-group-add-group' => 'This is the text on the button allowing to add a group of properties to be watched on [[Special:SemanticWatchlist]].
{{Identical|Add group}}',
	'swl-custom-legend' => 'This is the title of the field that lets you specify a custom text for the user notification to be send in case a property included in the group was changed.',
	'swl-custom-remove-property' => 'This is the text on the button allowing to remove the custom user notification text of a group.',
	'swl-custom-text-add' => 'This is the text on the button allowing to add a custom user notification text to a group.',
	'swl-custom-input' => 'This message explains that if the property $1 changes its value to $2 notify users with the text $3
* $1 - property name
* $2 - property value
* $3 - notification text',
	'swl-watchlist-position' => "The message explains how many changes are displayed in the special page ($1) and what's the number of the first one shown ($2): the special page provides results in paginated format. # stands for number.",
	'swl-watchlist-insertions' => 'This message precedes the display of the new property value set for the watched property.
{{Identical|New}}',
	'swl-watchlist-deletions' => 'This message precedes the display of the old property value set for the watched property.
{{Identical|Old}}',
	'swl-watchlist-pagincontrol' => 'This message allows to navigate through the changes on [[Special:SemanticWatchlist]] in a paginated format.
* $1 - replaced by {{msg-mw|Swl-watchlist-firstn}}
* $2 - replaced by {{msg-mw|Nextn}}
{{Identical|View}}',
	'swl-watchlist-firstn' => 'This message precedes the number of changes that are initially displayed on [[Special:SemanticWatchlist]].
* $1 - number of changes 
{{Identical|First}}',
	'swl-watchlist-firstn-title' => 'This message precedes the number of results that are displayed on [[Special:SemanticWatchlist]].
* $1 - number of results
{{Identical|First}}',
	'swl-watchlist-no-items' => 'This is an informatory message.',
	'swl-watchlist-can-mod-groups' => 'This is an informatory message.
* $1 is a wiki link to [[Special:WatchlistConditions]].',
	'swl-watchlist-can-mod-prefs' => 'This is an informatory message.
* $1 is a wiki link to [[Special:Preferences]].',
	'swl-watchlist-no-groups' => 'This is an informatory message.
* $1 is a wiki link to [[Special:Preferences]].',
	'swl-email-propschanged' => 'This it the title of the user notification e-mail informing about changes on watched properties.
* $1 - name of the page which was changed',
	'swl-email-propschanged-long' => 'This is the user notification e-mail informing about changes on watched properties.
* $1 - name of the wiki
* $2 - name of the user
* $3 - URL
* $4 - time
* $5 - date
Example screenshot: [[mw:File:Swl-email.png|see here]]',
	'swl-email-changes' => 'This is a section title within the user notification e-mail.
* $1 - the title of the page on which the property was changed
* $2 - the link (URL) to the page on which the property was changed
Example screenshot: [[mw:File:Swl-email.png|see here]]',
	'prefs-swl' => 'This is the text of the semantic watchlist section on [[Special:Preferences]] allowing users to set their preferences for semantic watchlists as well as to select the semantic watchlists which should be watched.',
	'prefs-swlgroup' => 'This is the text of the a header in the semantic watchlist section on [[Special:Preferences]] allowing users to select the semantic watchlists which should be watched.',
	'prefs-swlglobal' => 'This is the text of the a header in the semantic watchlist section on [[Special:Preferences]] allowing users to set their preferences for semantic watchlists.',
	'swl-prefs-emailnofity' => 'This message describes a user preference option in the semantic watchlist section on [[Special:Preferences]], which may be chosen.',
	'swl-prefs-watchlisttoplink' => 'This message describes a user preference option in the semantic watchlist section on [[Special:Preferences]], which may be chosen.',
	'swl-prefs-category-label' => 'This message describes a user preference option in the semantic watchlist section on [[Special:Preferences]], which may be chosen. It is used to display available group(s) that may be selected.
* $1 - the name of the group
* $2 - the number of properties watched by the group
* $3 - the name of the property/properties watched by the group
* $4 - the name of the category watched by the group',
	'swl-prefs-namespace-label' => 'This message describes a user preference option in the semantic watchlist section on [[Special:Preferences]], which may be chosen.  It is used to display available group(s) that may be selected.
* $1 - the name of the group
* $2 - the number of properties watched by the group
* $3 - the name of the property/properties watched by the group
* $4 - the name of the namespace watched by the group',
	'swl-prefs-concept-label' => 'This message describes a user preference option in the semantic watchlist section on [[Special:Preferences]], which may be chosen. It is used to display available group(s) that may be selected.
* $1 - the name of the group
* $2 - the number of properties watched by the group
* $3 - the name of the property/properties watched by the group
* $4 - the name of the concept watched by the group',
	'swl-err-userid-xor-groupids' => 'This is an error message.',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 */
$messages['af'] = array(
	'swl-group-saved' => 'Gestoor', # Fuzzy
);

/** Azerbaijani (azərbaycanca)
 * @author Cekli829
 */
$messages['az'] = array(
	'swl-group-save' => 'Qeyd et',
	'swl-group-category' => 'kateqoriya',
	'swl-watchlist-insertions' => 'Yeni:',
	'swl-watchlist-deletions' => 'Qədim:',
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author Jim-by
 * @author Renessaince
 */
$messages['be-tarask'] = array(
	'swl-group-save' => 'Захаваць',
	'swl-group-saved' => 'Захаваны', # Fuzzy
	'swl-group-saving' => 'Захаваньне',
	'swl-group-category' => 'катэгорыя',
	'swl-group-namespace' => 'прастора назваў',
	'swl-group-concept' => 'канцэпт',
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
 * @author පසිඳු කාවින්ද
 */
$messages['bg'] = array(
	'swl-group-legend' => 'Група',
	'swl-group-save' => 'Съхраняване',
	'swl-group-remove' => 'Премахване',
	'swl-group-category' => 'категория',
	'swl-custom-remove-property' => 'Премахване',
	'swl-watchlist-insertions' => 'Ново:',
	'swl-watchlist-deletions' => 'Стари:',
);

/** Breton (brezhoneg)
 * @author Fohanno
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'swl-group-name' => 'Anv ar strollad :',
	'swl-group-legend' => 'Strollad',
	'swl-properties-list' => 'Dispartiañ an anvioù gant |',
	'swl-group-page-selection' => 'Pajennoù e', # Fuzzy
	'swl-group-save' => 'Enrollañ',
	'swl-group-saved' => 'Enrollet', # Fuzzy
	'swl-group-saving' => "Oc'h enrollañ",
	'swl-group-category' => 'rummad',
	'swl-group-namespace' => 'esaouenn anv',
	'swl-group-concept' => 'meizad',
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
 * @author Alvaro Vidal-Abarca
 * @author Pitort
 * @author Toniher
 */
$messages['ca'] = array(
	'swl-group-name' => 'Nom del grup:',
	'swl-group-save' => 'Desa',
	'swl-group-saved' => "S'ha desat la configuració.",
	'swl-group-saving' => "S'està desant",
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'espai de noms',
	'swl-group-concept' => 'concepte',
	'swl-group-add-new-group' => 'Afegeix un grup nou',
	'swl-group-add-group' => 'Afegeix un grup',
	'swl-watchlist-insertions' => 'Nou:',
	'swl-watchlist-deletions' => 'Antic:',
	'swl-watchlist-firstn-title' => '$1 {{PLURAL:$1|primer resultat|primers resultats}}',
	'swl-email-propschanged' => 'Les propietats han canviat a $1',
	'prefs-swlgroup' => 'Grups a vigilar',
	'prefs-swlglobal' => 'Opcions generals',
	'swl-prefs-emailnofity' => "Envia'm un correu electrònic quan hi hagi canvis en les propietats que segueixo",
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|propietat|propietats}} $3 de la categoria ''$4''",
);

/** Chechen (нохчийн)
 * @author Умар
 */
$messages['ce'] = array(
	'swl-group-saving' => 'Ӏалашяр',
	'swl-prefs-emailnofity' => 'Аса тергал еш йолучарна хийцам бича электронан почте баийта хаам',
);

/** Czech (česky)
 * @author Vks
 */
$messages['cs'] = array(
	'swl-group-name' => 'Jméno skupiny:',
	'swl-group-properties' => 'Atributy této skupiny:', # Fuzzy
	'swl-group-page-selection' => 'Stránky v', # Fuzzy
	'swl-group-save' => 'Uložit',
	'swl-group-saved' => 'Uložené', # Fuzzy
	'swl-group-saving' => 'Ukládá se',
	'swl-group-category' => 'kategorie',
	'swl-group-namespace' => 'jmenný prostor',
	'swl-group-concept' => 'koncept',
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
	'swl-group-name' => 'Gruppenname:',
	'swl-group-legend' => 'Gruppe',
	'swl-group-properties' => 'Diese Gruppe beobachtet Änderungen am Attribut / an den Attributen:',
	'swl-properties-list' => 'Namen mit „|“ voneinander trennen',
	'swl-group-page-selection' => 'Wähle die zu beobachtenden Seiten aus:',
	'swl-group-save' => 'Speichern',
	'swl-group-remove' => 'Entfernen',
	'swl-group-saved' => 'Die Einstellungen wurden gespeichert.',
	'swl-group-saving' => 'Speichere …',
	'swl-group-category' => 'Kategorie',
	'swl-group-namespace' => 'Namensraum',
	'swl-group-concept' => 'Konzept',
	'swl-group-confirm-remove' => 'Soll die Gruppe „$1“ tatsächlich gelöscht werden?',
	'swl-group-add-new-group' => 'Eine neue Gruppe hinzufügen',
	'swl-group-add-group' => 'Eine Gruppe hinzufügen',
	'swl-custom-legend' => 'Benutzerdefinierter Text:',
	'swl-custom-remove-property' => 'Entfernen',
	'swl-custom-text-add' => 'Benutzerdefinierten Text hinzufügen',
	'swl-custom-input' => 'Sofern der Wert des Attributs $1 zu $2 geändert wurde, sollen die Benutzer mit dem folgendem Text benachrichtigt werden: $3',
	'swl-watchlist-position' => "Anzeige der letzten {{PLURAL:$1|Änderung|'''$1''' Änderungen beginnend mit Änderung '''$2'''}}:",
	'swl-watchlist-insertions' => 'Neu:',
	'swl-watchlist-deletions' => 'Alt:',
	'swl-watchlist-pagincontrol' => 'Zeige ($1) ($2)',
	'swl-watchlist-firstn' => 'erste $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Das erste Ergebnis|Die ersten $1 Ergebnisse}}',
	'swl-watchlist-no-items' => 'Es befinden sich keine Einträge auf deiner Beobachtungsliste.',
	'swl-watchlist-can-mod-groups' => 'Du kannst [[$1|die Gruppen]] anpassen.',
	'swl-watchlist-can-mod-prefs' => 'Du kannst auch [[$1|die Einstellungen der semantischen Beobachtungsliste]], einschließlich der zu beobachtenden Attribute, anpassen.',
	'swl-watchlist-no-groups' => 'Du beobachtest bislang noch keine Gruppen. [[$1|Pass deine Einstellungen an]].',
	'swl-email-propschanged' => 'Attribute wurden auf $1 geändert',
	'swl-email-propschanged-long' => "Eines oder mehrere der auf '''$1''' beobachteten Attribute wurden {{GENDER:$2|vom Benutzer|von der Benutzerin}} '''$2''' am $5 um $4 Uhr geändert. Diese und andere Änderungen werden auf [$3 dieser semantischen Beobachtungsliste] angezeigt.",
	'swl-email-changes' => 'Attributänderungen auf [$2 $1]:',
	'prefs-swl' => 'Semantische Beobachtungsliste',
	'prefs-swlgroup' => 'Beobachtbare Gruppen',
	'prefs-swlglobal' => 'Allgemeine Optionen',
	'swl-prefs-emailnofity' => 'Bei Änderungen an beobachteten Attributen E-Mails senden',
	'swl-prefs-watchlisttoplink' => 'Einen Link zur semantischen Beobachtungsliste oben auf der Seite im Benutzermenü anzeigen',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 in Kategorie ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 im Namensraum ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|Attribut|Attribute}} $3 im Konzept ''$4''",
	'swl-err-userid-xor-groupids' => 'Es muss entweder der Parameter für die Benutzerkennung oder für die Gruppenkennung angegeben werden, jedoch nicht beide gleichzeitig.',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'swl-watchlist-no-items' => 'Es befinden sich keine Einträge auf Ihrer Beobachtungsliste.',
	'swl-watchlist-can-mod-groups' => 'Sie können [[$1|die Gruppen]] anpassen.',
	'swl-watchlist-can-mod-prefs' => 'Sie können [[$1|die Einstellungen der semantischen Beobachtungsliste]], einschließlich der zu beobachtenden Attribute, anpassen.', # Fuzzy
	'swl-watchlist-no-groups' => 'Sie beobachten bislang noch keine Gruppen. [[$1|Passen Sie Ihre Einstellungen an]].',
);

/** Zazaki (Zazaki)
 * @author Marmase
 * @author Mirzali
 */
$messages['diq'] = array(
	'swl-group-category' => 'Kategori',
	'swl-group-namespace' => 'cayê namey',
	'swl-watchlist-insertions' => 'Newe:',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'semanticwatchlist-desc' => 'Zmóžnja zdźělenje wěstych změnow na semantiskich datach',
	'right-semanticwatch' => 'semantisku wobglědowańsku lisćinu wužywaś',
	'right-semanticwatchgroups' => 'Kupki semantiskeje wobglěodwanskeje lisćiny [[Special:WatchlistConditions|změniś]]',
	'special-semanticwatchlist' => 'Semantiska wobglědowańska lisćina',
	'special-watchlistconditions' => 'Wuměnjenja semantiskeje wobglědowańskeje lisćiny',
	'swl-group-name' => 'Mě kupki:',
	'swl-group-legend' => 'Kupka',
	'swl-group-properties' => 'Toś ta kupka wobglědujo změny w kakosćach:',
	'swl-group-page-selection' => 'Boki wubraś, kótarež maju se wobglědaś:',
	'swl-group-save' => 'Składowaś',
	'swl-group-remove' => 'Wótpóraś',
	'swl-group-saved' => 'Nastajenja su se składowali.',
	'swl-group-saving' => 'Składujo se',
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'mjenjowy rum',
	'swl-group-concept' => 'koncept',
	'swl-group-add-new-group' => 'Nowu kupku pśidaś',
	'swl-group-add-group' => 'Kupku pśidaś',
	'swl-custom-legend' => 'Swójski tekst',
	'swl-custom-remove-property' => 'Wótpóraś',
	'swl-custom-text-add' => 'Swójski tekst pśidaś',
	'swl-watchlist-position' => "{{PLURAL:$1|Pokazujo|Pokazujotej|Pokazuju|Pokazujo}} se '''$1''' {{PLURAL:$1|slědna změna|slědnjej změnje|slědne změny|slědnych změnow}}, zachopinajucy z '''$2'''.", # Fuzzy
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
	'swl-group-name' => 'Nombre del grupo:',
	'swl-group-legend' => 'Grupo',
	'swl-group-properties' => 'Este grupo sigue los cambios realizados en la/s propiedad/propiedades',
	'swl-properties-list' => 'Separa los nombres con |',
	'swl-group-page-selection' => 'Selecciona las páginas a ver:',
	'swl-group-save' => 'Guardar',
	'swl-group-remove' => 'Eliminar',
	'swl-group-saved' => 'Guardado', # Fuzzy
	'swl-group-saving' => 'Guardando',
	'swl-group-category' => 'categoría',
	'swl-group-namespace' => 'espacio de nombres',
	'swl-group-concept' => 'concepto',
	'swl-group-confirm-remove' => '¿Está seguro de querer borrar el grupo de la lista de vigilancia "$1"?',
	'swl-group-add-new-group' => 'Añadir un nuevo grupo',
	'swl-group-add-group' => 'Añadir grupo',
	'swl-custom-legend' => 'Texto personalizado',
	'swl-custom-remove-property' => 'Eliminar',
	'swl-custom-text-add' => 'Agregar texto personalizado',
	'swl-custom-input' => 'Si la propiedad $1 cambia su valor a $2, notificar a los usuarios con el siguiente texto: $3', # Fuzzy
	'swl-watchlist-position' => "Mostrando {{PLURAL:$1|el último cambio|los '''$1''' últimos cambios}}, comezando por el '''# $2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Añadido:',
	'swl-watchlist-deletions' => 'Antiguo:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => '$1 primeras',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|primer resultado|$1 primeros resultados}}',
	'swl-watchlist-no-items' => 'No tiene ningún elemento en su lista de vigilancia semántica.',
	'swl-watchlist-can-mod-groups' => 'Puede [[$1|modificar los grupos de la lista de vigilancia]].',
	'swl-watchlist-can-mod-prefs' => 'Puede [[$1|modificar las preferencias de su lista de vigilancia]], incluidas las propiedades que quiera vigilar.', # Fuzzy
	'swl-watchlist-no-groups' => 'Aún no estás vigilando ningún grupo de la lista de seguimiento. [[$1|Modifica las preferencias de tu lista de seguimiento]].',
	'swl-email-propschanged' => 'Las propiedades han cambiado en $1',
	'swl-email-propschanged-long' => "El usuario '''$2''' ha modificado una o más propiedades que vigila en '''$1''' el $5 a las $4. Puede ver estas y otras modificaciones [$3 en su lista de vigilancia semántica].", # Fuzzy
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
 * @author Pikne
 */
$messages['et'] = array(
	'swl-group-name' => 'Rühma nimi:',
	'swl-group-legend' => 'Rühm',
	'swl-group-save' => 'Salvesta',
	'swl-group-saved' => 'Sätted salvestati.',
	'swl-group-saving' => 'Salvestamisel',
	'swl-group-category' => 'kategooria',
	'swl-group-namespace' => 'nimeruum',
	'swl-group-add-new-group' => 'Lisa uus rühm',
	'swl-group-add-group' => 'Lisa rühm',
	'swl-watchlist-insertions' => 'Uus:',
	'swl-watchlist-deletions' => 'Vana:',
);

/** Persian (فارسی)
 * @author Ebraminio
 * @author Mjbmr
 * @author ZxxZxxZ
 */
$messages['fa'] = array(
	'swl-group-name' => 'نام گروه:',
	'swl-group-legend' => 'گروه',
	'swl-group-save' => 'ذخیره',
	'swl-group-remove' => 'حذف',
	'swl-group-saved' => 'ذخیره شده', # Fuzzy
	'swl-group-saving' => 'در حال ذخیره‌سازی...',
	'swl-group-category' => 'رده',
	'swl-group-namespace' => 'فضای نام',
	'swl-group-add-new-group' => 'افزودن گروه جدید',
	'swl-group-add-group' => 'افزودن گروه',
	'swl-custom-legend' => 'متن سفارشی',
	'swl-custom-remove-property' => 'حذف',
	'swl-custom-text-add' => 'افزودن متن سفارشی',
	'swl-watchlist-insertions' => 'جدید:',
	'swl-watchlist-deletions' => 'قدیمی:',
	'prefs-swlglobal' => 'گزینه‌های عمومی',
);

/** Finnish (suomi)
 * @author Crt
 * @author Nedergard
 * @author Nike
 */
$messages['fi'] = array(
	'semanticwatchlist-desc' => 'Sallii ilmoitukset käyttäjille, kun semanttisen MediaWikin tietoihin on tehty tiettyjä muutoksia.',
	'right-semanticwatch' => 'Käyttää semanttista tarkkailulistaa',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Muokkaa]] semanttisen tarkkailulistan ryhmiä',
	'special-semanticwatchlist' => 'Semanttinen tarkkailulista',
	'special-watchlistconditions' => 'Semanttisen tarkkailulistan ehdot',
	'swl-group-name' => 'Ryhmän nimi',
	'swl-group-legend' => 'Ryhmä',
	'swl-group-properties' => 'Tämä ryhmä tarkkailee seruaavien ominaisuuksien muutoksia:',
	'swl-properties-list' => 'Nimet erotetaan | -merkillä',
	'swl-group-page-selection' => 'Tarkkailtavat sivut:',
	'swl-group-save' => 'Tallenna',
	'swl-group-remove' => 'Poista',
	'swl-group-saved' => 'Asetukset tallennettiin.',
	'swl-group-saving' => 'Tallennetaan',
	'swl-group-category' => 'luokka',
	'swl-group-namespace' => 'nimiavaruus',
	'swl-group-concept' => 'konsepti',
	'swl-group-confirm-remove' => 'Haluatko varmasti poistaa "$1" -tarkkailulistaryhmän?',
	'swl-group-add-new-group' => 'Lisää uusi ryhmä',
	'swl-group-add-group' => 'Lisää ryhmä',
	'swl-custom-legend' => 'Käyttäjän määrittämä teksti',
	'swl-custom-remove-property' => 'Poista',
	'swl-custom-text-add' => 'Lisää käyttäjän määrittämä teksti',
	'swl-custom-input' => 'Jos ominaisuuden $1 muutettu arvo on $2, ilmoita siitä käyttäjille huomautuksella: $3', # Fuzzy
	'swl-watchlist-position' => "Näyttää '''$1''' {{PLURAL:$1|muutoksen|viimeisintä muutosta}}, joista ensimmäinen on '''#$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Uusi:',
	'swl-watchlist-deletions' => 'Vanha:',
	'swl-watchlist-pagincontrol' => 'Näytä ($1) ($2)',
	'swl-watchlist-firstn' => 'ensimmäinen $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Ensimmäinen muutos|Ensimmäiset $1 muutosta}}',
	'swl-watchlist-no-items' => 'Semanttinen tarkkailulistasi on tyhjä.',
	'swl-watchlist-can-mod-groups' => 'Voit [[$1|muokata tarkkailulistaryhmiä]].',
	'swl-watchlist-can-mod-prefs' => 'Voit myös [[$1|muokata tarkkailulistan asetuksia]] ja määrittää tarkkailtavat ominaisuudet.',
	'swl-watchlist-no-groups' => 'Tarkkailulistallasi ei ole ryhmiä. [[$1|Muokkaa tarkkailulistan asetuksia]].',
	'swl-email-propschanged' => 'Ominaisuuksia on muutettu $1',
	'swl-email-propschanged-long' => "'''$1''' -wikin tarkkailulistallasi on muutoksia, jotka on tehnyt '''$2''' $5 klo $4. Voit tarkastella näitä ja muita muutoksia [$3 semanttisella tarkkailulistallasi].", # Fuzzy
	'swl-email-changes' => 'Ominaisuuden muutos [$2 $1]:',
	'prefs-swl' => 'Semanttinen tarkkailulista',
	'prefs-swlgroup' => 'Tarkkailtavat ryhmät',
	'prefs-swlglobal' => 'Yleiset asetukset',
	'swl-prefs-emailnofity' => 'Lähetä sähköposti, jos tarkkailulistallani olevia ominaisuuksia muutetaan.',
	'swl-prefs-watchlisttoplink' => 'Näytä semanttisen tarkkailulistan linkki sivun ylälaidassa',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|ominaisuus|ominaisuutta}} $3 luokasta ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|ominaisuus|ominaisuutta}} $3 nimiavaruudesta ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|ominaisuus|ominaisuutta}} $3 konseptista ''$4''",
	'swl-err-userid-xor-groupids' => 'Joko userid- tai groupid-parametri täytyy määrittää, mutta ei kuitenkaan molempia samanaikaisesti.',
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
	'swl-group-name' => 'Nom du groupe:',
	'swl-group-legend' => 'Groupe',
	'swl-group-properties' => 'Ce groupe surveille les changements dans la(les) propriété(s):',
	'swl-properties-list' => 'Noms séparés par |',
	'swl-group-page-selection' => 'Sélectionner les pages à surveiller:',
	'swl-group-save' => 'Enregistrer',
	'swl-group-remove' => 'Supprimer',
	'swl-group-saved' => 'Les paramètres ont été enregistrés.',
	'swl-group-saving' => 'Enregistrement en cours',
	'swl-group-category' => 'catégorie',
	'swl-group-namespace' => 'espace de noms',
	'swl-group-concept' => 'concept',
	'swl-group-confirm-remove' => 'Êtes-vous sûr de vouloir supprimer le "$1" du groupe de la liste de surveillance?',
	'swl-group-add-new-group' => 'Ajouter un nouveau groupe',
	'swl-group-add-group' => 'Ajouter un groupe',
	'swl-custom-legend' => 'Texte personnalisé',
	'swl-custom-remove-property' => 'Supprimer',
	'swl-custom-text-add' => 'Ajouter un texte personnalisé',
	'swl-custom-input' => 'Si la propriété $1 change de valeur en $2, notifier les utilisateurs avec le texte suivant : $3',
	'swl-watchlist-position' => "Afficher {{PLURAL:$1|la dernière modification|les '''$1''' dernières modifications à partir de la modification '''#$2'''}}.",
	'swl-watchlist-insertions' => 'Ajouté :',
	'swl-watchlist-deletions' => 'Ancien:',
	'swl-watchlist-pagincontrol' => 'Voir ($1) ($2)',
	'swl-watchlist-firstn' => '$1 premiers',
	'swl-watchlist-firstn-title' => '$1 {{PLURAL:$1|permier résultat|premiers résultats}}',
	'swl-watchlist-no-items' => "Vous n'avez aucun élément dans votre liste de suivi sémantique.",
	'swl-watchlist-can-mod-groups' => 'Vous pouvez [[$1|modifier les groupes de la liste de suivi]].',
	'swl-watchlist-can-mod-prefs' => 'Vous pouvez aussi [[$1|modifier les préférences de votre liste de suivi]], y compris la définition des propriétés à suivre.',
	'swl-watchlist-no-groups' => 'Vous ne suivez pour le moment aucun groupe de liste de suivi. [[$1|Modifiez vos préférences de liste de suivi]].',
	'swl-email-propschanged' => 'Les propriétés ont changé à $1',
	'swl-email-propschanged-long' => "Une ou plusieurs propriétés que vous suivez à '''$1'' ont été modifiées par l'{{GENDER:$2|utilisateur|utilisatrice}} '''$2''' à $4 sur $5 . Vous pouvez visualiser ces modifications et d'autres sur [$3 votre liste de suivi sémantique].",
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
	'swl-group-name' => 'Nom de la tropa :',
	'swl-group-properties' => 'Propriètâts de ceta tropa :', # Fuzzy
	'swl-group-page-selection' => 'Pâges dens la', # Fuzzy
	'swl-group-save' => 'Encartar',
	'swl-group-saved' => 'Encartâ', # Fuzzy
	'swl-group-saving' => 'Encartâjo en cors',
	'swl-group-category' => 'catègorie',
	'swl-group-namespace' => 'èspâço de noms',
	'swl-group-concept' => 'concèpte',
	'swl-group-add-new-group' => 'Apondre una tropa novèla',
	'swl-group-add-group' => 'Apondre una tropa',
	'swl-watchlist-position' => "Fâre vêre '''$1''' des dèrriérs changements en comencient per '''#$2'''.", # Fuzzy
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
	'swl-group-name' => 'Nome do grupo:',
	'swl-group-legend' => 'Grupo',
	'swl-group-properties' => 'Este grupo vixía os cambios feitos na(s) propiedade(s):',
	'swl-properties-list' => 'Separe os nomes cunha barra vertical ("|")',
	'swl-group-page-selection' => 'Seleccione as páxinas a vixiar:',
	'swl-group-save' => 'Gardar',
	'swl-group-remove' => 'Eliminar',
	'swl-group-saved' => 'Gardouse a configuración.',
	'swl-group-saving' => 'Gardando',
	'swl-group-category' => 'categoría',
	'swl-group-namespace' => 'espazo de nomes',
	'swl-group-concept' => 'concepto',
	'swl-group-confirm-remove' => 'Está seguro de querer eliminar o grupo da lista de vixilancia "$1"?',
	'swl-group-add-new-group' => 'Engadir un novo grupo',
	'swl-group-add-group' => 'Engadir o grupo',
	'swl-custom-legend' => 'Texto personalizado',
	'swl-custom-remove-property' => 'Eliminar',
	'swl-custom-text-add' => 'Engadir texto personalizado',
	'swl-custom-input' => 'Se a propiedade "$1" cambia o seu valor a "$2", notifíquese aos usuarios co seguinte texto: $3', # Fuzzy
	'swl-watchlist-position' => "Mostrando {{PLURAL:$1|o último cambio|'''$1''' cambios, comezando polo '''nº$2'''}}:",
	'swl-watchlist-insertions' => 'Engadido:',
	'swl-watchlist-deletions' => 'Vello:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => '$1 primeiras',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Primeiro resultado|Primeiros $1 resultados}}',
	'swl-watchlist-no-items' => 'Non ten elementos na súa lista de vixilancia semántica.',
	'swl-watchlist-can-mod-groups' => 'Pode [[$1|modificar os grupos da lista de vixilancia]].',
	'swl-watchlist-can-mod-prefs' => 'Tamén pode [[$1|modificar as preferencias da súa lista de vixilancia]], incluídas as propiedades que queira vixiar.',
	'swl-watchlist-no-groups' => 'Aínda non está a vixiar ningún dos grupos da lista de vixilancia. [[$1|Modifique as preferencias da súa lista de vixilancia]].',
	'swl-email-propschanged' => 'As propiedades cambiaron ás $1',
	'swl-email-propschanged-long' => "{{GENDER:$2|O usuario|A usuaria}} '''$2''' modificou unha ou máis propiedades que vixía en '''$1''' o $5 ás $4. Pode ollar estas e outras modificacións [$3 na súa lista de vixilancia semántica].",
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
	'swl-group-properties' => 'Attribut vo derre Grupp:', # Fuzzy
	'swl-group-page-selection' => 'Syte in', # Fuzzy
	'swl-group-save' => 'Spychere',
	'swl-group-saved' => 'Gspycheret', # Fuzzy
	'swl-group-saving' => 'Am Spychere',
	'swl-group-category' => 'Kategorii',
	'swl-group-namespace' => 'Namensruum',
	'swl-group-concept' => 'Konzept',
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
	'swl-group-name' => 'Mjeno skupiny:',
	'swl-group-legend' => 'Skupina',
	'swl-group-properties' => 'Tuta skupina wobkedźbuje změny w kajkosćach:',
	'swl-properties-list' => 'Mjena přez | dźělić',
	'swl-group-page-selection' => 'Strony wubrać, kotrež maja so wobkedźbować:',
	'swl-group-save' => 'Składować',
	'swl-group-remove' => 'Wotstronić',
	'swl-group-saved' => 'Nastajenja su so składowali.',
	'swl-group-saving' => 'Składuje so',
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'mjenowy rum',
	'swl-group-concept' => 'Koncept',
	'swl-group-confirm-remove' => 'Chceš woprawdźe skupinu wobkedźbowanskeje lisćiny "$1" wotstronić?',
	'swl-group-add-new-group' => 'Nowu skupinu přidać',
	'swl-group-add-group' => 'Skupinu přidać',
	'swl-custom-legend' => 'Swójski tekst',
	'swl-custom-remove-property' => 'Wotstronić',
	'swl-custom-text-add' => 'Swójski tekst přidać',
	'swl-custom-input' => 'Jeli kajkosć $1 swoju hódnotu do $2 změni, wužiwarjow ze slědowacym tekstom informować: $3', # Fuzzy
	'swl-watchlist-position' => "{{PLURAL:$1|Pokazuje|Pokazujetej|Pokazuja|Pokazuje}} so '''$1''' {{PLURAL:$1|poslednja změna|poslednjej změnje|poslednje změny|poslednich změnow}}, započinajo z '''$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Nowy:',
	'swl-watchlist-deletions' => 'Stary:',
	'swl-watchlist-pagincontrol' => '($1) ($2) pokazać',
	'swl-watchlist-firstn' => 'prěni $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Prěni wuslědk|Prěnjej $1 wuslědkaj|Prěnje $1 wuslědki|Prěnich $1 wuslědkow}}',
	'swl-watchlist-no-items' => 'Nimaš žane zapiski w swojej semantiskej wobkedźbowanskej lisćinje.',
	'swl-watchlist-can-mod-groups' => 'Móžeš [[$1|skupiny wobkedźbowanskeje lisćiny změnić]].',
	'swl-watchlist-can-mod-prefs' => 'Móžeš tež [[$1| nastajenja swojeje wobkedźbowanskeje lisćiny změnić]], inkluziwnje nastajenje, kotre kajkosće maja so wobkedźbować.',
	'swl-watchlist-no-groups' => 'Hišće njewobkedźbuješ wobkedźbowanske skupiny. [[$1|Změń swoje nastajenja za wobkedźbowanske lisćiny]].',
	'swl-email-propschanged' => 'Kajkosće su so do $1 změnili',
	'swl-email-propschanged-long' => "Jedna kajkosć abo wjacore kajkosće, kotrež wobkedźbuješ na '''$1''', su so wot {{GENDER:$2|wužiwarja|wužiwarki}} '''$2''' $5 w $4 změnili. Móžeš sej tute a druhe změny na [$3 swojej semantiskej wobkedźbowanskej lisćinje] wobhladać.",
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
	'swl-group-name' => 'Nomine del gruppo:',
	'swl-group-properties' => 'Proprietates coperite per iste gruppo:', # Fuzzy
	'swl-group-page-selection' => 'Paginas in', # Fuzzy
	'swl-group-save' => 'Salveguardar',
	'swl-group-saved' => 'Salveguardate', # Fuzzy
	'swl-group-saving' => 'Salveguarda in curso',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'spatio de nomines',
	'swl-group-concept' => 'concepto',
	'swl-group-add-new-group' => 'Adder un nove gruppo',
	'swl-group-add-group' => 'Adder gruppo',
	'swl-watchlist-position' => "Presenta '''$1''' del ultime modificationes a partir del '''№ $2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Addite:',
	'swl-watchlist-deletions' => 'Ancian:',
	'swl-watchlist-pagincontrol' => 'Vider ($1) ($2)',
	'swl-watchlist-firstn' => 'prime $1',
	'swl-watchlist-firstn-title' => 'Le prime {{PLURAL:$1|resultato|$1 resultatos}}',
	'swl-watchlist-no-items' => 'Tu non ha elementos sub observation.',
	'swl-watchlist-can-mod-groups' => 'Tu pote [[$1|modificar le gruppos del observatorio]].',
	'swl-watchlist-can-mod-prefs' => 'Tu pote [[$1|modificar le preferentias de tu observatorio]], p.ex. specificar le proprietates a observar.', # Fuzzy
	'swl-watchlist-no-groups' => 'Tu non ancora observa un gruppo de observatorio. [[$1|Modifica le preferentias de tu observatorio]].',
	'swl-email-propschanged' => 'Proprietates ha cambiate a $1',
	'swl-email-propschanged-long' => "Un o plus proprietates que tu observa a '''$1''' ha essite cambiate per le usator '''$2''' le $5 a $4. Tu pote vider iste e altere cambios in [$3 tu observatorio semantic].", # Fuzzy
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
 * @author පසිඳු කාවින්ද
 */
$messages['id'] = array(
	'semanticwatchlist-desc' => 'Memungkinkan penetapan kelompok properti semantik untuk satu atau lebih kategori/ruang nama yang kemudian dapat dipantau perubahannya', # Fuzzy
	'right-semanticwatch' => 'Menggunakan daftar pantauan semantik',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Mengubah]] kelompok daftar pantauan semantik',
	'special-semanticwatchlist' => 'Daftar Pantau Semantik',
	'special-watchlistconditions' => 'Kriteria daftar pantau semantik',
	'swl-group-name' => 'Nama kelompok:',
	'swl-group-legend' => 'Kelompok',
	'swl-group-properties' => 'Properti yang dicakup oleh kelompok ini:', # Fuzzy
	'swl-group-page-selection' => 'Halaman dalam', # Fuzzy
	'swl-group-save' => 'Simpan',
	'swl-group-remove' => 'Hapus',
	'swl-group-category' => 'kategori',
	'swl-custom-remove-property' => 'Hapus',
	'swl-watchlist-insertions' => 'Baru:',
	'swl-watchlist-deletions' => 'Tua:',
);

/** Italian (italiano)
 * @author Beta16
 * @author F. Cosoleto
 * @author පසිඳු කාවින්ද
 */
$messages['it'] = array(
	'swl-group-name' => 'Nome gruppo:',
	'swl-group-legend' => 'Gruppo',
	'swl-group-save' => 'Salva',
	'swl-group-remove' => 'Rimuovi',
	'swl-group-saved' => 'Le impostazioni sono state salvate.',
	'swl-group-saving' => 'Salvataggio',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'namespace',
	'swl-group-add-new-group' => 'Aggiungi un nuovo gruppo',
	'swl-group-add-group' => 'Aggiungi gruppo',
	'swl-custom-remove-property' => 'Rimuovi',
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
	'swl-group-name' => 'グループ名:',
	'swl-group-legend' => 'グループ',
	'swl-group-properties' => 'このグループではプロパティの変更をウォッチします:',
	'swl-properties-list' => '名前を | で区切る',
	'swl-group-page-selection' => 'ウォッチするページを選択:',
	'swl-group-save' => '保存',
	'swl-group-remove' => '除去',
	'swl-group-saved' => '設定を保存しました。',
	'swl-group-saving' => '保存中',
	'swl-group-category' => 'カテゴリ',
	'swl-group-namespace' => '名前空間',
	'swl-group-concept' => '概念',
	'swl-group-confirm-remove' => 'ウォッチリストのグループ「$1」を本当に除去しますか?',
	'swl-group-add-new-group' => '新規グループを追加',
	'swl-group-add-group' => 'グループを追加',
	'swl-custom-legend' => 'カスタム テキスト',
	'swl-custom-remove-property' => '除去',
	'swl-custom-text-add' => 'カスタム テキストを追加',
	'swl-custom-input' => 'プロパティ $1 の値が $2 に変わった場合、以下の内容で利用者に通知する: $3',
	'swl-watchlist-insertions' => '新:',
	'swl-watchlist-deletions' => '旧:',
	'swl-watchlist-pagincontrol' => '表示 ($1) ($2)',
	'swl-watchlist-firstn' => '最初の $1 件',
	'swl-watchlist-firstn-title' => '最初の $1 {{PLURAL:$1|件の結果}}',
	'swl-watchlist-no-items' => '意味的ウォッチリストには何も項目がありません。',
	'swl-watchlist-can-mod-groups' => '[[$1|ウォッチリストのグループを変更]]できます。',
	'swl-watchlist-can-mod-prefs' => 'ウォッチするプロパティの設定など、[[$1|ウォッチリストの設定を変更]]することもできます。',
	'swl-watchlist-no-groups' => 'どのウォッチリスト グループもウォッチしていません。[[$1|ウォッチリストの設定を変更]]してください。',
	'swl-email-propschanged' => 'プロパティは$1に変更されました',
	'swl-email-propschanged-long' => "'''$1'''であなたがウォッチしている1つ以上のプロパティが、$5 $4に{{GENDER:$2|利用者}} '''$2''' によって変更されました。これらおよびその他の変更は[$3 あなたの意味的ウォッチリスト]で閲覧できます。",
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
	'right-semanticwatch' => 'სემანტიკური სიის გამოყენება',
	'right-semanticwatchgroups' => 'სემანტიკური კონტროლის სიის ჯგუფების [[Special:WatchlistConditions|შეცვლა]]',
	'special-semanticwatchlist' => 'სემანტიკური კონტროლის სია',
	'special-watchlistconditions' => 'სემანტიკური კონტროლის სიის პირობები',
	'swl-group-name' => 'ჯგუფის სახელი:',
	'swl-group-legend' => 'ჯგუფი',
	'swl-properties-list' => 'სახელების გაცალკევება „|“-ით',
	'swl-group-page-selection' => 'სანახავად აირჩიეთ გვერდები:',
	'swl-group-save' => 'შენახვა',
	'swl-group-remove' => 'წაშლა',
	'swl-group-saved' => 'კონფიგურაცია შენახულია.',
	'swl-group-saving' => 'ინახება',
	'swl-group-category' => 'კატეგორია',
	'swl-group-namespace' => 'სახელთა სივრცე',
	'swl-group-concept' => 'კონცეფცია',
	'swl-group-add-new-group' => 'ახალი ჯგუფის დამატება',
	'swl-group-add-group' => 'ჯგუფის დამატება',
	'swl-custom-legend' => 'მომხმარებლის ტექსტი',
	'swl-custom-remove-property' => 'წაშლა',
	'swl-custom-text-add' => 'მომხმარების ტექსტის დამატება',
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
	'swl-group-save' => '저장',
	'swl-group-saved' => '설정을 저장했습니다.',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'semanticwatchlist-desc' => 'Määt et müjjelesch, Jroppe vun semantesche Eijeschaffte aanzjävve, för Saachjroppe un Appachtemangs, di dann op en Oppaßleß kumme un bewach wääde, för der Fall, dat se jeändert wääde.', # Fuzzy
	'right-semanticwatch' => 'De semantesche Oppaßleß verwände',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Jroppe ändere]] för de semantesche Oppaßleßte',
	'special-semanticwatchlist' => 'Semantesch Oppaßleß',
	'special-watchlistconditions' => 'Enshtällonge för de semantesche Oppaßleßte',
	'swl-watchlist-position' => "Mer zeije {{PLURAL:$1|de läzde Änderong, dat es|'''$1''' vun de läzde Änderonge aff|nix aff}} Nommer '''$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Neu:',
);

/** Kurdish (Latin script) (Kurdî (latînî)‎)
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
	'swl-group-name' => 'Numm vum Grupp:',
	'swl-group-legend' => 'Grupp',
	'swl-properties-list' => 'Nimm mat | trennen',
	'swl-group-page-selection' => "Sicht Säiten eraus fir z'iwwerwaachen:",
	'swl-group-save' => 'Späicheren',
	'swl-group-remove' => 'Ewechhuelen',
	'swl-group-saved' => "D'Astellunge goufe gespäichert",
	'swl-group-saving' => 'Späicheren',
	'swl-group-category' => 'Kategorie',
	'swl-group-namespace' => 'Nummraum',
	'swl-group-concept' => 'Konzept',
	'swl-group-confirm-remove' => "Sidd Dir sécher datt Dir d'''$1''-Iwwerwaachungslëscht-Grupp ewechhuele wëllt?",
	'swl-group-add-new-group' => 'Eng nei Grupp derbäisetzen',
	'swl-group-add-group' => 'Grupp derbäisetzen',
	'swl-custom-legend' => 'Personaliséierten Text',
	'swl-custom-remove-property' => 'Ewechhuelen',
	'swl-custom-text-add' => 'Personaliséierten Text derbäisetzen',
	'swl-watchlist-insertions' => 'Derbäigesat:',
	'swl-watchlist-deletions' => 'Al:',
	'swl-watchlist-pagincontrol' => '($1) ($2) weisen',
	'swl-watchlist-firstn' => 'éischt $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Dat éischt Resultat|Déi éischt $1 Resultater}}',
	'swl-watchlist-no-items' => 'Dir hutt keng Objeten op Ärer Iwwerwaachungslëscht.',
	'swl-watchlist-can-mod-groups' => "Dir kënnt [[$1|d'Gruppe vun der Iwwerwaachungslëscht änneren]].",
	'swl-email-propschanged' => "D'Eegeschafte goufen op $1 geännert",
	'swl-email-changes' => 'Ännerunge vun Eegescheschaften op [$2 $1]:',
	'prefs-swl' => 'Semantesch Iwwerwaachungslëscht',
	'prefs-swlgroup' => "Gruppe fir z'iwwerwaachen",
	'prefs-swlglobal' => 'Allgemeng Optiounen',
	'swl-prefs-emailnofity' => 'Mir eng Mail schécke wann Attributer déi ech iwwerwaachen geännert ginn',
);

/** Latvian (latviešu)
 * @author Papuass
 */
$messages['lv'] = array(
	'swl-group-name' => 'Grupas nosaukums:',
	'swl-group-legend' => 'Grupa',
	'swl-group-save' => 'Saglabāt',
	'swl-group-remove' => 'Noņemt',
	'swl-group-saving' => 'Saglabā',
	'swl-group-category' => 'kategorija',
	'swl-group-add-new-group' => 'Pievienot jaunu grupu',
	'swl-group-add-group' => 'Pievienot grupu',
	'swl-custom-legend' => 'Pielāgots teksts',
	'swl-custom-remove-property' => 'Noņemt',
	'swl-custom-text-add' => 'Pievienot pielāgotu tekstu',
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
	'swl-group-name' => 'Име на групата:',
	'swl-group-legend' => 'Група',
	'swl-group-properties' => 'Оваа група ги следи промените во својството/својствата:',
	'swl-properties-list' => 'Одделувајте ги имињата со „|“',
	'swl-group-page-selection' => 'Одберете страници за надгледување:',
	'swl-group-save' => 'Зачувај',
	'swl-group-remove' => 'Отстрани',
	'swl-group-saved' => 'Нагодувањата се зачувани.',
	'swl-group-saving' => 'Зачувувам',
	'swl-group-category' => 'категорија',
	'swl-group-namespace' => 'именски простор',
	'swl-group-concept' => 'концепт',
	'swl-group-confirm-remove' => 'Дали сте сигурни дека сакате да ја избришете групата „$1“ од списокот на набљудувања?',
	'swl-group-add-new-group' => 'Додај нова група',
	'swl-group-add-group' => 'Додај група',
	'swl-custom-legend' => 'Прилагоден текст',
	'swl-custom-remove-property' => 'Отстрани',
	'swl-custom-text-add' => 'Стави прилагоден текст',
	'swl-custom-input' => 'Ако својството $1 си ја промени вредноста на $2, извести ги корисниците со следниов текст: $3',
	'swl-watchlist-position' => "Приказ на {{PLURAL:$1|последната промена|последните '''$1''' промени, почнувајќи од '''бр. $2'''}}:",
	'swl-watchlist-insertions' => 'Додадено:',
	'swl-watchlist-deletions' => 'Стари:',
	'swl-watchlist-pagincontrol' => 'Видете ($1) ($2)',
	'swl-watchlist-firstn' => 'први $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Прв $1 резултат|Први $1 резултати}}',
	'swl-watchlist-no-items' => 'Немате ништо во списокот на набљудувања.',
	'swl-watchlist-can-mod-groups' => 'Можете да ги [[$1|измените групите на набљудувања]].',
	'swl-watchlist-can-mod-prefs' => 'Можете и да ги [[$1|измените вашите нагодувања за набљудување]], вклучувајќи кои својства да се набљудуваат.',
	'swl-watchlist-no-groups' => 'Сè уште не набљудувате ниедна група со списоци на набљудувања. [[$1|Измени нагодувања]].',
	'swl-email-propschanged' => 'Својствата на $1 се имаат изменето',
	'swl-email-propschanged-long' => "{{GENDER:$2|Корисникот}} '''$2''' на $5 во $4 ч. измени едно или повеќе својства на '''$1''' што ги набљудувате. Можете да ги погледате овие и други промени на [$3 вашиот семантички список на набљудувања].",
	'swl-email-changes' => 'Измени во својства на [$2 $1]:',
	'prefs-swl' => 'Семантички список на набљудувања',
	'prefs-swlgroup' => 'Групи за набљудување',
	'prefs-swlglobal' => 'Општи можности',
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
	'semanticwatchlist-desc' => 'Membolehkan pemberitahuan kepada pengguna tentang perubahan tertentu pada data Semantic MediaWiki',
	'right-semanticwatch' => 'Menggunakan senarai pantau semantik',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Mengubah suai]] kumpulan senarai pantau semantik',
	'special-semanticwatchlist' => 'Senarai Pantau Semantik',
	'special-watchlistconditions' => 'Syarat-syarat senarai pantau semantik',
);

/** Maltese (Malti)
 * @author Chrisportelli
 */
$messages['mt'] = array(
	'swl-group-category' => 'kategorija',
	'swl-group-namespace' => 'spazju tal-isem',
	'swl-group-concept' => 'kunċett',
	'swl-group-add-new-group' => 'Żid grupp ġdid',
	'swl-group-add-group' => 'Żid grupp',
	'swl-watchlist-insertions' => 'Ġdid:',
	'swl-watchlist-deletions' => 'Qadim:',
);

/** Norwegian Bokmål (norsk bokmål)
 * @author Event
 */
$messages['nb'] = array(
	'semanticwatchlist-desc' => 'Lar brukere bli informert om spesifikke endringer i Semantic MediaWiki-data.',
	'right-semanticwatch' => 'Bruk semantisk overvåkningsliste',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Endre]] gruppene for semantiske overvåkningslister',
	'special-semanticwatchlist' => 'Semantisk overvåkningsliste',
	'special-watchlistconditions' => 'Betingelser for semantisk overvåkningsliste',
	'swl-group-name' => 'Gruppenavn:',
	'swl-group-properties' => 'Egenskaper dekket av denne gruppen:', # Fuzzy
	'swl-group-page-selection' => 'Sider i', # Fuzzy
	'swl-group-save' => 'Lagre',
	'swl-group-saved' => 'Lagret', # Fuzzy
	'swl-group-saving' => 'Lagrer',
	'swl-group-category' => 'kategori',
	'swl-group-namespace' => 'navnerom',
	'swl-group-concept' => 'begrep',
	'swl-group-add-new-group' => 'Legg til ny gruppe',
	'swl-group-add-group' => 'Legg til gruppe',
	'swl-watchlist-position' => "Viser '''$1''' av {{PLURAL:$1|den siste endringen|de siste endringene}} som begynner med '''#$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Ny:',
	'swl-watchlist-deletions' => 'Gammel:',
	'swl-watchlist-pagincontrol' => 'Vis ($1) ($2)',
	'swl-watchlist-firstn' => 'første $1',
	'swl-watchlist-firstn-title' => 'Første {{PLURAL:$1|resultat|$1 resultater}}',
	'swl-watchlist-no-items' => 'Du har ingen elementer på din semantiske overvåkningsliste.',
	'swl-watchlist-can-mod-groups' => 'Du kan [[$1|endre gruppene for overvåkningslister]].',
	'swl-watchlist-can-mod-prefs' => 'Du kan [[$1|endre dine innstillinger for overvåkningslister]], herunder å velge hvilken egenskaper som skal overvåkes.', # Fuzzy
	'swl-watchlist-no-groups' => 'Du har ikke aktivisert noen grupper av overvåkningslister. [[$1|Endre dine innstillinger for overvåkningslister]].',
	'swl-email-propschanged' => 'Egenskaper er endret på $1',
	'swl-email-propschanged-long' => "En eller flere egenskaper du overvåker på '''$1'' har blitt endret av bruker '''$2''' på $4 den $5. Du kan se på disse og andre endringer på [$3 din semantiske overvåkningsliste]", # Fuzzy
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
	'swl-group-name' => 'Groepsnaam:',
	'swl-group-legend' => 'Groep',
	'swl-group-properties' => 'In deze groep worden wijzigen aan de volgende eigenschap(pen) bijgehouden:',
	'swl-properties-list' => 'Scheid namen met "|"',
	'swl-group-page-selection' => "Selecteer te volgen pagina's:",
	'swl-group-save' => 'Opslaan',
	'swl-group-remove' => 'Verwijderen',
	'swl-group-saved' => 'De instellingen zijn opgeslagen.',
	'swl-group-saving' => 'Bezig met opslaan',
	'swl-group-category' => 'categorie',
	'swl-group-namespace' => 'naamruimte',
	'swl-group-concept' => 'concept',
	'swl-group-confirm-remove' => 'Weet u zeker dat u de volglijstgroep "$1" wilt verwijderen?',
	'swl-group-add-new-group' => 'Nieuwe groep toevoegen',
	'swl-group-add-group' => 'Groep toevoegen',
	'swl-custom-legend' => 'Aangepaste tekst',
	'swl-custom-remove-property' => 'Verwijderen',
	'swl-custom-text-add' => 'Aangepaste tekst toevoegen',
	'swl-custom-input' => 'Als de waarde van de eigenschap $1 wijzigt naar $2, waarschuw dan alle gebruikers met de volgende tekst: $3',
	'swl-watchlist-position' => "{{PLURAL:$1|De laatste wijziging wordt weergegeven|Er worden '''$1''' recente wijzigingen weergegeven beginnend met '''#$2'''}}.",
	'swl-watchlist-insertions' => 'Nieuw:',
	'swl-watchlist-deletions' => 'Oud:',
	'swl-watchlist-pagincontrol' => 'Bekijken ($1) ($2)',
	'swl-watchlist-firstn' => 'eerste $1',
	'swl-watchlist-firstn-title' => 'Eerste $1 {{PLURAL:$1|resultaat|resultaten}}',
	'swl-watchlist-no-items' => 'Uw semantische volglijst is leeg.',
	'swl-watchlist-can-mod-groups' => 'U kunt de [[$1|volglijstgroepen aanpassen]].',
	'swl-watchlist-can-mod-prefs' => 'U kunt ook [[$1|uw volglijstwijzigingen aanpassen]], inclusief welke eigenschappen gevolgd moeten worden.',
	'swl-watchlist-no-groups' => 'U volgt nog geen volglijstgroepen. U kunt [[$1|uw volglijstinstellingen aanpassen]].',
	'swl-email-propschanged' => 'Eigenschappen zijn veranderd op $1',
	'swl-email-propschanged-long' => "Een of meer eigenschappen die u volgt op '''$1''' zijn gewijzigd door gebruiker '''{{GENDER:$2|$2}}''' op $5 om $4. U kunt deze en andere wijzigingen bekijken op [$3 uw semantische volglijst].",
	'swl-email-changes' => 'Wijzigingen in eigenschappen op [$2 $1]:',
	'prefs-swl' => 'Semantische volglijst',
	'prefs-swlgroup' => 'Te volgen groepen',
	'prefs-swlglobal' => 'Algemene opties',
	'swl-prefs-emailnofity' => 'Mij e-mailen bij wijzigingen in eigenschappen die ik volg',
	'swl-prefs-watchlisttoplink' => 'Bovenaan de pagina een koppeling weergeven naar de semantische volglijst',
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
	'swl-group-saved' => 'Bhalde', # Fuzzy
);

/** Pälzisch (Pälzisch)
 * @author Manuae
 */
$messages['pfl'] = array(
	'swl-group-save' => 'Schbaischere',
	'swl-group-saved' => 'Oischdellung sinn gschbaischad',
	'swl-watchlist-pagincontrol' => 'Zaisch ($1) ($2)',
	'swl-watchlist-no-items' => 'Du dudschd nix beobachde.',
);

/** Polish (polski)
 * @author Woytecr
 */
$messages['pl'] = array(
	'swl-group-save' => 'Zapisz',
	'swl-group-remove' => 'Usuń',
	'swl-group-saved' => 'Ustawienia zostały zapisane.',
	'swl-group-saving' => 'Zapisywanie',
	'swl-group-category' => 'kategoria',
	'swl-group-namespace' => 'przestrzeń nazw',
	'swl-group-add-new-group' => 'Dodaj nową grupę',
	'swl-group-add-group' => 'Dodaj grupę',
	'swl-custom-legend' => 'Własny tekst',
	'swl-custom-remove-property' => 'Usuń',
	'swl-custom-text-add' => 'Dodaj własny tekst',
	'swl-watchlist-insertions' => 'Nowy:',
	'swl-watchlist-deletions' => 'Stary:',
	'swl-watchlist-pagincontrol' => 'Zobacz ($1) ($2)',
	'swl-watchlist-firstn' => 'pierwsze $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|$1 wynik|Pierwsze $1 wyników}}',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'semanticwatchlist-desc' => "A përmet a j'utent d'esse avisà ëd modìfiche spessìfiche ant ij dat ëd MediaWiki semàntich",
	'right-semanticwatch' => "Dovra la lista semàntica ëd lòn ch'as ten sot-euj",
	'right-semanticwatchgroups' => "[[Special:WatchlistConditions|Modifiché]] le partìe dla lista semàntica ëd lòn ch'as ten sot-euj",
	'special-semanticwatchlist' => "Lista Semàntica ëd lòn ch'as ten sot-euj",
	'special-watchlistconditions' => "Condission dla lista semàntica ëd lòn ch'as ten sot-euj",
	'swl-group-name' => 'Nòm ëd la partìa:',
	'swl-group-legend' => 'Partìa',
	'swl-group-properties' => 'Costa partìa a ten sot-euj ij cangiament ant la/le propietà:',
	'swl-properties-list' => 'Separa ij nòm con |',
	'swl-group-page-selection' => 'Selessioné le pàgine da ten-e sot-euj:',
	'swl-group-save' => 'Salva',
	'swl-group-remove' => 'Gava',
	'swl-group-saved' => "J'ampostassion a son stàite salvà.",
	'swl-group-saving' => 'An salvand',
	'swl-group-category' => 'categorìa',
	'swl-group-namespace' => 'spassi nominal',
	'swl-group-concept' => 'concèt',
	'swl-group-confirm-remove' => "Ses-to sigur ëd vorèj gavé la partìa «$1» d'la lista ël lòn ch'as ten sot-euj?",
	'swl-group-add-new-group' => 'Gionta na partìa neuva',
	'swl-group-add-group' => 'Gionté na partìa',
	'swl-custom-legend' => 'Test përsonalisà',
	'swl-custom-remove-property' => 'Gava',
	'swl-custom-text-add' => 'Gionté un test përsonalisà',
	'swl-custom-input' => "Se la propietà $1 a cangia ij sò valor a $2, notifiché j'utent con ël test sì-dapress: $3", # Fuzzy
	'swl-watchlist-position' => "Mostré '''$1''' {{PLURAL:$1|dl'ùltima modìfica|dj'ùltime modìfiche}} an ancaminand con '''#$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Neuv:',
	'swl-watchlist-deletions' => 'Vej:',
	'swl-watchlist-pagincontrol' => 'Varda ($1) ($2)',
	'swl-watchlist-firstn' => 'prim $1',
	'swl-watchlist-firstn-title' => 'Prim $1 {{PLURAL:$1|arzultà}}',
	'swl-watchlist-no-items' => "A l'ha ancor gnun element dzora a soa lista semàntica ëd lòn ch'as ten sot-euj.",
	'swl-watchlist-can-mod-groups' => "A peule [[$1|modifiché le partìe dla lista ëd lòn ch'as ten sot-euj]].",
	'swl-watchlist-can-mod-prefs' => "A peul ëdcò [[$1|modifiché ij sò gust ëd la lista ëd lòn ch'as ten sot-euj]], comprèis amposté che propietà tnì sot-euj.",
	'swl-watchlist-no-groups' => "Për adess a ten sot-euj gnun-a partìe ëd liste ëd ròba da ten-e sot-euj. [[$1|Ch'a modìfica ij sò gust dla lista ëd lòn ch'a ten sot-euj]].",
	'swl-email-propschanged' => "Le propietà a l'han cangià a $1",
	'swl-email-propschanged-long' => "Un-a o pi propietà ch'it ten-e sot euj a '''$1''' a son stàite modificà da l'{{GENDER:$2|utent}} '''$2''' ai $4 dël $5. A peul vëdde costa e d'àutre modìfiche dzora a [$3 soa lista semàntica ëd lòn ch'as ten sot-euj].",
	'swl-email-changes' => 'Cambi ëd propietà dzora [$2 $1]:',
	'prefs-swl' => "Lista semàntica ëd lòn ch'as ten sot-euj",
	'prefs-swlgroup' => 'Partìe da ten-e sot-euj',
	'prefs-swlglobal' => 'Opsion generaj',
	'swl-prefs-emailnofity' => "Mandeme un mëssagi an sle modìfiche a le propietà ch'im ten-o sot-euj",
	'swl-prefs-watchlisttoplink' => "Smon-e na liura a la Lista Semàntica ëd lòn ch'as ten sot-euj an testa a la pàgina",
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|propietà}} $3 da categorìa ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|propietà}} $3 da spassi nominal ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|propietà}} $3 da concèt ''$4''",
	'swl-err-userid-xor-groupids' => 'A venta spessifiché o bin ël paràmeter userid opura ël groupid, ma pa tùit doi.',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'swl-group-name' => 'د ډلې نوم:',
	'swl-group-save' => 'خوندي کول',
	'swl-group-saved' => 'امستنې مو خوندي شوې.',
	'swl-group-saving' => 'خوندي کېدنې کې دی...',
	'swl-group-category' => 'وېشنيزه',
	'swl-group-namespace' => 'نوم-تشيال',
	'swl-group-add-new-group' => 'يوه نوې ډله ورگډول',
	'swl-group-add-group' => 'ډله ورگډول',
	'swl-watchlist-insertions' => 'نوی:',
	'swl-watchlist-deletions' => 'زوړ:',
	'swl-watchlist-pagincontrol' => 'کتل ($1) ($2)',
);

/** Portuguese (português)
 * @author Giro720
 * @author Hamilton Abreu
 * @author Luckas
 */
$messages['pt'] = array(
	'semanticwatchlist-desc' => 'Permite que os utilizadores sejam notificados de alterações específicas aos dados do MediaWiki Semântico',
	'right-semanticwatch' => 'Usar a lista de propriedades semânticas vigiadas',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Alterar]] os grupos de propriedades semânticas vigiadas',
	'special-semanticwatchlist' => 'Lista das Propriedades Semânticas Vigiadas',
	'special-watchlistconditions' => 'Condições da lista das propriedades semânticas vigiadas',
	'swl-group-name' => 'Nome de grupo:',
	'swl-group-properties' => 'Propriedades abrangidas por este grupo:', # Fuzzy
	'swl-group-page-selection' => 'Páginas em', # Fuzzy
	'swl-group-save' => 'Gravar',
	'swl-group-saved' => 'Gravado', # Fuzzy
	'swl-group-saving' => 'A gravar',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'espaço nominal',
	'swl-group-concept' => 'conceito',
	'swl-group-add-new-group' => 'Adicionar um grupo novo',
	'swl-group-add-group' => 'Adicionar grupo',
	'swl-watchlist-position' => "A mostrar '''$1''' das últimas alterações, começando pela '''$2ª'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Adições:',
	'swl-watchlist-deletions' => 'Antigas:',
	'swl-watchlist-pagincontrol' => 'Ver ($1) ($2)',
	'swl-watchlist-firstn' => 'primeiras $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Primeiro resultado|Primeiros $1 results}}',
	'swl-watchlist-no-items' => 'A sua lista de propriedades semânticas vigiadas está vazia.',
	'swl-watchlist-can-mod-groups' => 'Pode [[$1|alterar os grupos de propriedades semânticas vigiadas]].',
	'swl-watchlist-can-mod-prefs' => 'Pode [[$1|alterar as suas preferências das propriedades semânticas vigiadas]], incluindo definir quais as propriedades que pretende vigiar.', # Fuzzy
	'swl-watchlist-no-groups' => 'Ainda não está a vigiar nenhum grupo de propriedades semânticas vigiadas. [[$1|Alterar as suas preferências das propriedades semânticas vigiadas]].',
	'swl-email-propschanged' => 'Propriedades alteradas na $1',
	'swl-email-propschanged-long' => "Uma ou mais propriedades que está a vigiar na '''$1''' foram alteradas pelo utilizador '''$2''' às $4 de $5. Pode ver estas e outras alterações  na sua [$3 lista de propriedades semânticas vigiadas].", # Fuzzy
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

/** Brazilian Portuguese (português do Brasil)
 * @author Luckas
 * @author Luckas Blade
 */
$messages['pt-br'] = array(
	'swl-group-save' => 'Salvar',
	'swl-group-saved' => 'As configurações foram salvas.',
	'swl-group-saving' => 'Salvando',
	'swl-group-category' => 'categoria',
	'swl-group-namespace' => 'domínio',
	'swl-group-concept' => 'conceito',
	'swl-group-add-new-group' => 'Adicionar um novo grupo',
	'swl-group-add-group' => 'Adicionar grupo',
	'prefs-swlglobal' => 'Opções gerais',
);

/** Romanian (română)
 * @author Minisarm
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'swl-group-name' => 'Numele grupului:',
	'swl-group-legend' => 'Grup',
	'swl-properties-list' => 'Separați numele cu |',
	'swl-group-save' => 'Salvare',
	'swl-group-remove' => 'Eliminare',
	'swl-group-saved' => 'Setările au fost salvate.',
	'swl-group-category' => 'categorie',
	'swl-group-add-new-group' => 'Adaugă un grup nou',
	'swl-group-add-group' => 'Adaugă grup',
	'swl-custom-legend' => 'Text personalizat',
	'swl-custom-remove-property' => 'Elimină',
	'swl-custom-text-add' => 'Adaugă text personalizat',
	'prefs-swlglobal' => 'Opțiuni generale',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'swl-group-name' => "Nome d'u gruppe:",
	'swl-group-legend' => 'Gruppe',
	'swl-group-save' => 'Reggistre',
	'swl-group-remove' => 'Live',
	'swl-group-saved' => "Le 'mbostaziune onne state reggistrate.",
	'swl-group-saving' => 'Stoche a reggistre',
	'swl-group-category' => 'categorije',
	'swl-group-namespace' => 'namespace',
	'swl-group-concept' => 'congette',
	'swl-watchlist-insertions' => 'Nuève:',
	'swl-watchlist-deletions' => 'Vicchie:',
);

/** Russian (русский)
 * @author Okras
 * @author ShinePhantom
 */
$messages['ru'] = array(
	'semanticwatchlist-desc' => 'Позволяет пользователям получать уведомления об определённых изменениях данных Семантической МедиаВики',
	'right-semanticwatch' => 'Использовать семантический список наблюдения',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Изменить]] группы семантического списка наблюдения',
	'special-semanticwatchlist' => 'Семантический список наблюдения',
	'special-watchlistconditions' => 'Условия семантического списка наблюдения',
	'swl-group-name' => 'Имя группы:',
	'swl-group-legend' => 'Группа',
	'swl-properties-list' => 'Разделяйте имена с помощью |',
	'swl-group-page-selection' => 'Выберите страницы для наблюдения:',
	'swl-group-save' => 'Сохранить',
	'swl-group-remove' => 'Удалить',
	'swl-group-saved' => 'Настройки были сохранены.',
	'swl-group-saving' => 'Сохранение',
	'swl-group-category' => 'категория',
	'swl-group-namespace' => 'пространство имён',
	'swl-group-concept' => 'концепт',
	'swl-group-add-new-group' => 'Добавить новую группу',
	'swl-group-add-group' => 'Добавить группу',
	'swl-custom-legend' => 'Пользовательский текст',
	'swl-custom-remove-property' => 'Удалить',
	'swl-custom-text-add' => 'Добавить пользовательский текст',
	'swl-watchlist-insertions' => 'Новое:',
	'swl-watchlist-deletions' => 'Старое:',
	'swl-watchlist-firstn' => 'первые $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1||Первые}} $1 {{PLURAL:$1|результат|результата|результатов}}',
	'swl-watchlist-can-mod-groups' => 'Вы можете [[$1|изменить группы списка наблюдения]].',
	'swl-email-propschanged' => 'Свойства изменились у $1',
	'swl-email-changes' => 'Изменения свойств на [$2 $1]:',
	'prefs-swl' => 'Семантический список наблюдения',
	'prefs-swlgroup' => 'Группы для наблюдения',
	'prefs-swlglobal' => 'Общие параметры',
	'swl-prefs-emailnofity' => 'Присылать мне письма по электронной почте при изменении свойств, за которыми я наблюдаю',
	'swl-prefs-watchlisttoplink' => 'Показывает ссылку для семантический список наблюдения вверху страницы',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|свойство|свойства|свойств}} $3 из категории ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|свойство|свойства|свойств}} $3 из пространства имён ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|свойство|свойства}} $3 из концепта ''$4''",
	'swl-err-userid-xor-groupids' => 'Должен быть задан либо параметр идентификатора пользователя, либо параметр идентификатора групп, но не оба сразу.',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'right-semanticwatch' => 'අර්ථ විචාර මුරලැයිස්තුව භාවිතා කරන්න',
	'special-semanticwatchlist' => 'අර්ථ විචාර මුරලැයිස්තුව',
	'special-watchlistconditions' => 'අර්ථ විචාර මුරලැයිස්තු කොන්දේසි',
	'swl-group-name' => 'කාණ්ඩ නාමය:',
	'swl-group-legend' => 'කාණ්ඩය',
	'swl-properties-list' => 'නම් | සමඟ වෙන් කරන්න',
	'swl-group-page-selection' => 'නැරඹිය යුතු පිටු තෝරන්න:',
	'swl-group-save' => 'සුරකින්න',
	'swl-group-remove' => 'ඉවත් කරන්න',
	'swl-group-saved' => 'සුරකින ලදී', # Fuzzy
	'swl-group-saving' => 'සුරකිමින්',
	'swl-group-category' => 'ප්‍රවර්ගය',
	'swl-group-namespace' => 'නාමඅවකාශය',
	'swl-group-concept' => 'සංකල්පය',
	'swl-group-confirm-remove' => 'ඔබට "$1" මුරලැයිස්තු සමූහය මැකීමට අවශ්‍යමද?',
	'swl-group-add-new-group' => 'නව සමූහයක් එක් කරන්න',
	'swl-group-add-group' => 'සමූහයක් එක් කරන්න',
	'swl-custom-legend' => 'ව්‍යවහාර පාඨය',
	'swl-custom-remove-property' => 'ඉවත් කරන්න',
	'swl-custom-text-add' => 'ව්‍යවහාර පාඨයක් එක් කරන්න',
	'swl-watchlist-insertions' => 'නව:',
	'swl-watchlist-deletions' => 'පැරණි:',
	'swl-watchlist-pagincontrol' => 'නරඹන්න ($1) ($2)',
	'swl-watchlist-firstn' => 'ප්‍රථම $1',
	'swl-watchlist-firstn-title' => 'ප්‍රථම {{PLURAL:$1|ප්‍රතිඵල}} $1',
	'swl-watchlist-no-items' => 'ඔබගේ අර්ථ විචාර මුරලැයිස්තුවේ කිසිදු අයිතමයක් නොමැත.',
	'swl-watchlist-can-mod-groups' => 'ඔබට [[$1|මුරලයිස්තු සමූහයන් වෙනස් කල හැක]].',
	'swl-email-propschanged' => 'වත්කම් $1 හිදී වෙනස් වී ඇත',
	'swl-email-changes' => '[$2 $1] හී වත්කම්වල වෙනස:',
	'prefs-swl' => 'අර්ථ විචාර මුරලැයිස්තුව',
	'prefs-swlgroup' => 'මුරකල යුතු යුතු සමූහ',
	'prefs-swlglobal' => 'ප්‍රධාන විකල්පයන්',
	'swl-prefs-emailnofity' => 'මම මුරකරන වත්කම්වල වෙනසක් වූ විට මට විද්‍යුත්-තැපෑලක් එවන්න',
);

/** Somali (Soomaaliga)
 * @author Maax
 */
$messages['so'] = array(
	'swl-group-category' => 'qeyb',
);

/** Swedish (svenska)
 * @author Martinwiss
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'semanticwatchlist-desc' => 'Informera användare om vissa ändringar av semantiska data',
	'right-semanticwatch' => 'Använd semantiska övervakningslistor',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Ändra]] grupperna för semantiska övervakningslistor',
	'special-semanticwatchlist' => 'Semantiska övervakningslistor',
	'special-watchlistconditions' => 'Inställningar för semantiska övervakningslistor',
	'swl-group-name' => 'Gruppnamn:',
	'swl-group-legend' => 'Grupp',
	'swl-group-properties' => 'Denna grupp bevakar ändringar i egenskapen/egenskaperna:',
	'swl-properties-list' => 'Separera namn med |',
	'swl-group-page-selection' => 'Välj sidor att bevaka:',
	'swl-group-save' => 'Spara',
	'swl-group-remove' => 'Ta bort',
	'swl-group-saved' => 'Inställningarna har sparats.',
	'swl-group-saving' => 'Sparar',
	'swl-group-category' => 'kategori',
	'swl-group-namespace' => 'namnrymd',
	'swl-group-concept' => 'begrepp',
	'swl-group-add-new-group' => 'Lägg till en ny grupp',
	'swl-group-add-group' => 'Lägg till grupp',
	'swl-custom-legend' => 'Anpassad text',
	'swl-custom-remove-property' => 'Ta bort',
	'swl-custom-text-add' => 'Lägg till anpassad text',
	'swl-watchlist-position' => "Visar {{PLURAL:$1|den senaste ändringen|de senaste '''$1''' ändringarna med början från ändringen '''#$2'''}}.",
	'swl-watchlist-insertions' => 'Ny:',
	'swl-watchlist-deletions' => 'Gammal:',
	'swl-watchlist-pagincontrol' => 'Visar ($1) ($2)',
	'swl-watchlist-firstn' => 'först $1',
	'swl-watchlist-firstn-title' => 'Första $1 {{PLURAL:$1|resultat|resultaten}}',
	'swl-watchlist-no-items' => 'Du har inget att övervaka på din semantiska övervakningslista',
	'swl-watchlist-can-mod-groups' => 'Du kan [[$1|grupperna för övervakningslistor]].',
	'swl-watchlist-can-mod-prefs' => 'Du kan även [[$1|ändra dina inställningar för övervakningslistor]], även ange vilka egenskaper som ska stämma överens.',
	'swl-watchlist-no-groups' => 'Du övervakar ännu inte några övervakningslistor. [[$1|Ändra dina inställningar för övervakningslistor]].',
	'swl-email-propschanged' => 'Egenskaper har ändrats vid $1',
	'swl-email-propschanged-long' => "En eller flera egenskaper som du övervakar vid '''$1''' har ändrats av {{GENDER:$2|användaren}} '''$2''' kl $4 den $5. Du kan visa dessa och andra ändringar på [$3 din semantiska övervakningslista].",
	'swl-email-changes' => 'Egenskapen ändrades vid [$2 $1]:',
	'prefs-swl' => 'Semantisk övervakningslista',
	'prefs-swlgroup' => 'Grupper att övervaka',
	'prefs-swlglobal' => 'Allmänna inställningar',
	'swl-prefs-emailnofity' => 'Skicka e-post till mig när egenskapar som jag övervakar ändras',
	'swl-prefs-watchlisttoplink' => 'Visa en länk till den Semantiska övervakningslistan överst på sidan',
	'swl-prefs-category-label' => "
'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 från kategori ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 från namnrymd ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|egenskap|egenskaper}} $3 från begrepp ''$4''",
	'swl-err-userid-xor-groupids' => 'Antingen måste parametern userid eller groupids anges (dock inte båda).',
);

/** Tamil (தமிழ்)
 * @author Karthi.dr
 * @author Shanmugamp7
 */
$messages['ta'] = array(
	'swl-group-name' => 'குழுப் பெயர்:',
	'swl-group-legend' => 'குழு',
	'swl-group-properties' => 'இந்தக் குழுவின் கீழ் உள்ள உடமைகள்:', # Fuzzy
	'swl-group-save' => 'சேமி',
	'swl-group-remove' => 'நீக்குக',
	'swl-group-saved' => 'சேமிக்கப்பட்டது', # Fuzzy
	'swl-group-saving' => 'சேமிக்கப்படுகிறது',
	'swl-group-category' => 'பகுப்பு',
	'swl-group-namespace' => 'பெயர்வெளி',
	'swl-group-concept' => 'கோட்பாடு',
	'swl-group-add-new-group' => 'ஒரு புதிய குழுவைச் சேர்',
	'swl-group-add-group' => 'குழுவைச் சேர்',
	'swl-custom-legend' => 'தனிப்பயனாக்கப்பட்ட உரை',
	'swl-custom-remove-property' => 'நீக்குக',
	'swl-custom-text-add' => 'தனிப்பயனாக்கப்பட்ட உரையை சேர்க்கவும்',
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
	'swl-group-name' => 'Pangalan ng pangkat:',
	'swl-group-properties' => 'Mga pag-aari na nasasakop ng pangkat na ito:', # Fuzzy
	'swl-group-page-selection' => 'Mga pahina sa loob ng', # Fuzzy
	'swl-group-save' => 'Sagipin',
	'swl-group-saved' => 'Nasagip na', # Fuzzy
	'swl-group-saving' => 'Sinasagip',
	'swl-group-category' => 'kategorya',
	'swl-group-namespace' => 'puwang ng pangalan',
	'swl-group-concept' => 'diwa',
	'swl-group-add-new-group' => 'Magdagdag ng isang bagong pangkat',
	'swl-group-add-group' => 'Idagdag ang pangkat',
	'swl-watchlist-position' => "Ipinapakita ang '''$1''' ng huling {{PLURAL:$1|pagbabago|mga pagbabago}} na nag-uumpisa sa '''#$2'''.", # Fuzzy
	'swl-watchlist-insertions' => 'Bago:',
	'swl-watchlist-deletions' => 'Luma:',
	'swl-watchlist-pagincontrol' => 'Tingnan ($1) ($2)',
	'swl-watchlist-firstn' => 'unang $1',
	'swl-watchlist-firstn-title' => 'Unang $1 {{PLURAL:$1|resulta|mga resulta}}',
	'swl-watchlist-no-items' => 'Walang kang mga bagay sa ibabaw ng iyong semantikong listahan ng mga binabantayan.',
	'swl-watchlist-can-mod-groups' => 'Maaari mong [[$1|baguhin ang mga pangkat ng listahan ng mga binabantayan]].',
	'swl-watchlist-can-mod-prefs' => 'Maaari mong [[$1|baguhin ang iyong mga kanaisan sa listahan ng mga binabantayan]], kabilang na ang pagtatakda ng kung aling mga pag-aari ang babantayan.', # Fuzzy
	'swl-watchlist-no-groups' => 'Hindi ka pa nagbabantay ng anumang mga pangkat ng mga binabantayan. [[$1|Baguhin ang iyong mga kanaisan sa listahan ng mga binabantayan]].',
	'swl-email-propschanged' => 'Nagbago ang mga pag-aari roon sa $1',
	'swl-email-propschanged-long' => "Binago ng tagagamit na si '''$2''' sa ganap na $4 noong $5 ang isa o mas mahigit pang mga pag-aaring binabantayan mo roon sa '''$1'''. Matitingnan mo ang mga ito at iba pang mga pagbabago roon sa [$3 iyong semantikong listahan ng mga binabantayan].", # Fuzzy
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

/** Central Atlas Tamazight (ⵜⴰⵎⴰⵣⵉⵖⵜ)
 * @author Tifinaghes
 */
$messages['tzm'] = array(
	'swl-group-legend' => 'ⵜⴰⵔⴰⴱⴱⵓⵜ',
);

/** Ukrainian (українська)
 * @author Andriykopanytsia
 * @author Base
 * @author Ата
 */
$messages['uk'] = array(
	'semanticwatchlist-desc' => 'Дозволяє користувачам бути сповіщеними про зміни у вибраних даних Semantic MediaWiki',
	'right-semanticwatch' => 'Використовувати семантичний список спостереження',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|Змінювати]] групи семантичного списку спостереження',
	'special-semanticwatchlist' => 'Семантичний список спостереження',
	'special-watchlistconditions' => 'Умови семантичного списку спостереження',
	'swl-group-name' => 'Назва групи:',
	'swl-group-legend' => 'Група',
	'swl-group-properties' => 'Ця група стежить за змінами за властивістю/властивостями:',
	'swl-properties-list' => 'Розділяйте назви за допомогою |',
	'swl-group-page-selection' => 'Обрати сторінки для спостереження:',
	'swl-group-save' => 'Зберегти',
	'swl-group-remove' => 'Вилучити',
	'swl-group-saved' => 'Налаштування збережено',
	'swl-group-saving' => 'Збереження',
	'swl-group-category' => 'категорія',
	'swl-group-namespace' => 'простір назв',
	'swl-group-concept' => 'концепт',
	'swl-group-confirm-remove' => 'Ви дійсно хочете вилучити групу списку спостереження «$1»?',
	'swl-group-add-new-group' => 'Додати нову групу',
	'swl-group-add-group' => 'Додати групу',
	'swl-custom-legend' => 'Власний текст',
	'swl-custom-remove-property' => 'Вилучити',
	'swl-custom-text-add' => 'Додати власний текст',
	'swl-custom-input' => 'Якщо властивість $1 змінила своє значення на $2, сповістити користувачів наступним текстом: $3',
	'swl-watchlist-position' => "Показано {{PLURAL:$1|останню зміну|останні '''$1''' зміни, починаючи з '''#$2'''}}:",
	'swl-watchlist-insertions' => 'Нові:',
	'swl-watchlist-deletions' => 'Старі:',
	'swl-watchlist-pagincontrol' => 'Перегляд ($1) ($2)',
	'swl-watchlist-firstn' => 'перший $1',
	'swl-watchlist-firstn-title' => '{{PLURAL:$1|Перший $1 результат|Перші $1 результати|Перші $1 результатів}}',
	'swl-watchlist-no-items' => 'У Вашому семантичному списку спостереження немає елементів.',
	'swl-watchlist-can-mod-groups' => 'Ви можете [[$1|змінювати групи списку спостереження]].',
	'swl-watchlist-can-mod-prefs' => 'Ви також можете [[$1|змінювати налаштування списку спостереження]], включно з вказанням тих властивостей, за якими спостерігати.',
	'swl-watchlist-no-groups' => 'Ви ще не спостерігаєте за жодною групою списку спостереження. [[$1|Змінити Ваші налаштування списку спостереження]].',
	'swl-email-propschanged' => 'Властивості $1 змінилися',
	'swl-email-propschanged-long' => "У проекті '''$1''' було змінено одну чи декілька властивостей, за якими Ви спостерігаєте, {{GENDER:$2|користувачем|користувачкою}} '''$2''' $4 о $5. Ви можете переглянути цю та інші зміни у [$3 своєму семантичному списку спостереження].",
	'swl-email-changes' => 'Зміни властивостей на сторінці [$2 $1]:',
	'prefs-swl' => 'Семантичний список спостереження',
	'prefs-swlgroup' => 'Групи для спостереження',
	'prefs-swlglobal' => 'Загальні параметри',
	'swl-prefs-emailnofity' => 'Повідомляти мене про зміни властивостей, за якими я спостерігаю, електронною поштою',
	'swl-prefs-watchlisttoplink' => 'Відображати посилання на семантичний список спостереження вгорі сторінки',
	'swl-prefs-category-label' => "'''$1''': {{PLURAL:$2|властивість|властивості|властивостей}} $3 з категорії ''$4''",
	'swl-prefs-namespace-label' => "'''$1''': {{PLURAL:$2|властивість|властивості|властивостей}} $3 з простору імен ''$4''",
	'swl-prefs-concept-label' => "'''$1''': {{PLURAL:$2|властивість|властивості|властивостей}} $3 з концепції ''$4''",
	'swl-err-userid-xor-groupids' => 'Повинен бути вказаний параметр ID користувача або груп, але не обидва.',
);

/** Urdu (اردو)
 * @author පසිඳු කාවින්ද
 */
$messages['ur'] = array(
	'swl-group-save' => 'محفوظ کریں',
	'swl-group-saved' => 'محفوظ کر لیا', # Fuzzy
	'swl-group-saving' => 'بچت',
	'swl-group-category' => 'زمرہ',
	'swl-group-namespace' => 'نیم سپیس',
	'swl-group-add-group' => 'گروپ میں شامل',
	'swl-watchlist-insertions' => 'نیا:',
	'swl-watchlist-deletions' => 'عمر:',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 * @author පසිඳු කාවින්ද
 */
$messages['vi'] = array(
	'swl-group-save' => 'Lưu',
	'swl-group-saved' => 'Đã lưu các tùy chọn.',
	'swl-group-saving' => 'Đang lưu',
	'swl-group-category' => 'thể loại',
	'swl-group-namespace' => 'không gian tên',
);

/** Yiddish (ייִדיש)
 * @author פוילישער
 * @author පසිඳු කාවින්ද
 */
$messages['yi'] = array(
	'swl-group-save' => 'אויפֿהיטן',
	'swl-group-category' => 'קאַטעגאריע',
	'swl-watchlist-firstn' => 'ערשטער $1',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Liangent
 * @author Linforest
 * @author Shirayuki
 * @author Xiaomingyan
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'semanticwatchlist-desc' => '让用户获得关于Semantic MediaWiki数据特定更改的通知',
	'right-semanticwatch' => '使用语义监视列表',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|修改]]语义监视列表组',
	'special-semanticwatchlist' => '语义监视列表',
	'special-watchlistconditions' => '语义监视列表条件',
	'swl-group-name' => '组名：',
	'swl-group-legend' => '组',
	'swl-group-properties' => '该组监视的属性更改：',
	'swl-properties-list' => '以“|”分隔名称',
	'swl-group-page-selection' => '选择要监视的页面：',
	'swl-group-save' => '保存',
	'swl-group-remove' => '移除',
	'swl-group-saved' => '设置已保存。',
	'swl-group-saving' => '正在保存……',
	'swl-group-category' => '类别',
	'swl-group-namespace' => '命名空间',
	'swl-group-concept' => '概念',
	'swl-group-confirm-remove' => '您确实要删除"$1"监视列表组吗？',
	'swl-group-add-new-group' => '添加新的组',
	'swl-group-add-group' => '添加组',
	'swl-custom-legend' => '自定义的文本',
	'swl-custom-remove-property' => '移除',
	'swl-custom-text-add' => '添加自定义文本',
	'swl-custom-input' => '如果属性$1的值变更为$2，以如下文本通知用户：$3', # Fuzzy
	'swl-watchlist-position' => "显示从'''#$2'''开始的，最后{{PLURAL:$1|变更|变更}}的'''$1'''。", # Fuzzy
	'swl-watchlist-insertions' => '新：',
	'swl-watchlist-deletions' => '旧：',
	'swl-watchlist-pagincontrol' => '查看 ($1) ($2)',
	'swl-watchlist-firstn' => '前$1',
	'swl-watchlist-firstn-title' => '前$1{{PLURAL:$1|项结果|项结果}}',
	'swl-watchlist-no-items' => '您的监视列表为空。',
	'swl-watchlist-can-mod-groups' => '您可以[[$1|修改监视列表组]]。',
	'swl-watchlist-can-mod-prefs' => '你也可以[[$1|修改你的监视列表设置]]，包括要监视的属性的设置。',
	'swl-watchlist-no-groups' => '您尚未监视任何的监视列表组。[[$1|请修改您的监视列表首选项]]。',
	'swl-email-propschanged' => '位于$1的属性已变更。',
	'swl-email-propschanged-long' => "您在'''$1'''所监视的一个或多个属性已被$5之上位于$4的用户'''$2'''更改。.您可以查看这些变更以及位于[$3 您的语义监视列表]之上的其他变更。", # Fuzzy
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

/** Traditional Chinese (中文（繁體）‎)
 * @author Ch.Andrew
 * @author Shirayuki
 */
$messages['zh-hant'] = array(
	'semanticwatchlist-desc' => '讓用戶獲得關於Semantic MediaWiki數據特定更改的通知',
	'right-semanticwatch' => '使用語義監視列表',
	'right-semanticwatchgroups' => '[[Special:WatchlistConditions|修改]]語義監視列表組',
	'special-semanticwatchlist' => '語義監視列表',
	'special-watchlistconditions' => '語義監視列表條件',
	'swl-group-name' => '組名：',
	'swl-group-legend' => '群組',
	'swl-group-properties' => '該組所涵蓋的屬性：', # Fuzzy
	'swl-group-page-selection' => '中的頁面', # Fuzzy
	'swl-group-save' => '保存',
	'swl-group-remove' => '移除',
	'swl-group-saved' => '設定已經儲存。',
	'swl-group-saving' => '正在保存……',
	'swl-group-category' => '類別',
	'swl-group-namespace' => '命名空間',
	'swl-group-concept' => '概念',
	'swl-group-add-new-group' => '添加新的組',
	'swl-group-add-group' => '添加組',
	'swl-custom-remove-property' => '移除',
	'swl-watchlist-position' => "顯示從'''#$2'''開始的，最後{{PLURAL:$1|變更|變更}}的'''$1'''。", # Fuzzy
	'swl-watchlist-insertions' => '新：',
	'swl-watchlist-deletions' => '舊：',
	'swl-watchlist-pagincontrol' => '查看 ($1) ($2)',
	'swl-watchlist-firstn' => '前$1',
	'swl-watchlist-firstn-title' => '前$1{{PLURAL:$1|項結果|項結果}}',
	'swl-watchlist-no-items' => '您的監視列表為空。',
	'swl-watchlist-can-mod-groups' => '您可以[[$1|修改監視列表組]]。',
	'swl-watchlist-can-mod-prefs' => '您可以[[$1|監視列表首選項]]，包括設置要監視哪些屬性。', # Fuzzy
	'swl-watchlist-no-groups' => '您尚未監視任何的監視列表組。[[$1|請修改您的監視列表首選項]]。',
	'swl-email-propschanged' => '位於$1的屬性已變更。',
	'swl-email-propschanged-long' => "您在'''$1'''所監視的一個或多個屬性已被$5之上位於$4的用戶'''$2'''更改。.您可以查看這些變更以及位於[$3 您的語義監視列表]之上的其他變更。", # Fuzzy
	'swl-email-changes' => '[$2 $1]之上的屬性變更：',
	'prefs-swl' => '語義監視列表',
	'prefs-swlgroup' => '要監視的組',
	'prefs-swlglobal' => '一般選項',
	'swl-prefs-emailnofity' => '電子郵件通知我那些對我所監視屬性的變更',
	'swl-prefs-watchlisttoplink' => '在頁面頂部顯示語義監視列表的鏈接',
	'swl-prefs-category-label' => "'''$1'''：來自類別''$4''的{{PLURAL:$2|屬性|屬性}} $3",
	'swl-prefs-namespace-label' => "'''$1'''來自命名空間''$4''的{{PLURAL:$2|屬性|屬性}} $3",
	'swl-prefs-concept-label' => "'''$1'''：來自概念''$4''的{{PLURAL:$2|屬性|屬性}} $3",
	'swl-err-userid-xor-groupids' => '需要指定用戶ID（userid ）或組ID（groupids ），但不要同時兩者都指定。',
);
