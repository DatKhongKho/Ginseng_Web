<?php

require_once( MWAI_PATH . '/constants/engines.php' );
require_once( MWAI_PATH . '/constants/models.php' );

define( 'MWAI_CHATBOT_DEFAULT_PARAMS', [
	// UI Parameters
	'aiName' => "AI: ",
	'userName' => "User: ",
	'guestName' => "Guest: ",
	'textSend' => 'Send',
	'textClear' => 'Clear',
	'textInputPlaceholder' => 'Type your message...',
	'textInputMaxLength' => 512,
	'textCompliance' => '',
	'startSentence' => "Hi! How can I help you?",
	'themeId' => 'chatgpt',
	'window' => false,
	'icon' => '',
	'iconText' => '',
	'iconTextDelay' => 1,
	'iconAlt' => 'AI Engine Chatbot',
	'iconPosition' => 'bottom-right',
	'iconBubble' => false,
	'fullscreen' => false,
	'copyButton' => false,
	'localMemory' => true,
	// Chatbot System Parameters
	'botId' => null,
	'instructions' => "Converse as if you were an AI assistant. Be friendly, creative.",
	'scope' => 'chatbot',
	'mode' => 'chat',
	'contentAware' => false,
	'embeddingsEnvId' => '',
	// AI Parameters
	'model' => MWAI_FALLBACK_MODEL,
	'temperature' => 0.8,
	'maxMessages' => 15,
	'maxTokens' => 1024,
	'maxResults' => 1,
	'apiKey' => null
] );

define( 'MWAI_LANGUAGES', [
  'en' => 'English',
	'de' => 'German',
	'fr' => 'French',
  'es' => 'Spanish',
  'it' => 'Italian',
	'zh' => 'Chinese',
	'ja' => 'Japanese',
  'pt' => 'Portuguese',
  //'ru' => 'Russian',
] );

define ( 'MWAI_LIMITS', [
	'enabled' => true,
	'guests' => [
		'credits' => 3,
		'creditType' => 'queries',
		'timeFrame' => 'day',
		'isAbsolute' => false,
		'overLimitMessage' => "You have reached the limit (check the Queries Tab > Limits > Guests).",
	],
	'users' => [
		'credits' => 10,
		'creditType' => 'price',
		'timeFrame' => 'month',
		'isAbsolute' => false,
		'overLimitMessage' => "You have reached the limit (check the Queries Tab > Limits > Users).",
		'ignoredUsers' => "administrator,editor",
	],
	'system' => [
		'credits' => 20,
		'creditType' => 'price',
		'timeFrame' => 'month',
		'isAbsolute' => false,
		'overLimitMessage' => "Our chatbot went to sleep. Please try again later.",
		'ignoredUsers' => "",
	],
] );

define( 'MWAI_OPTIONS', [
	'module_addons' => true,
	'module_suggestions' => true,
	'module_chatbots' => true,
	'module_forms' => false,
	'module_blocks' => false,
	'module_playground' => true,
	'module_generator_content' => true,
	'module_generator_images' => true,
	'module_moderation' => false,
	'module_statistics' => false,
	'module_finetunes' => false,
	'module_embeddings' => false,
	'module_transcription' => false,
	'module_advisor' => false,
	'speech_recognition' => false,
	'speech_synthesis' => false,
	'virtual_keyboard_fix' => false,
	'chatbot_gdpr_consent' => false,
	'chatbot_gdpr_text' => 'By using this chatbot, you agree to the recording and processing of your data by our website and the external services it might use (LLMs, vector databases, etc.).',
	'chatbot_gdpr_button' => 'I understand',
	'chatbot_typewriter' => false,
	'chatbot_discussions' => false,
	'chatbot_moderation' => false,
	'syntax_highlight' => false,
	'limits' => MWAI_LIMITS,

	// Settings for Images
	'image_local_upload' => 'uploads',
	'image_remote_upload' => 'data',
	'image_expires' => 1 * HOUR_IN_SECONDS,

	'ai_models' => [],
	'ai_models_usage' => [],
	'ai_streaming' => false,
	'ai_default_env' => null,
	'ai_default_model' => MWAI_FALLBACK_MODEL,
	'ai_envs' => [
		[
			'name' => 'OpenAI',
			'type' => 'openai',
			'apikey' => '',
			'finetunes' => [],
			'finetunes_deleted' => [],
			'legacy_finetunes' => [],
			'legacy_finetunes_deleted' => [],
			'usage' => [], // TODO:  We should only keep the last year of usage
		],
		[
			'name' => 'Claude',
			'type' => 'anthropic',
			'apikey' => '',
		]
	],

	'embeddings_default_env' => null,
	'embeddings_envs' => [
		[
			'name' => 'Pinecone',
			'type' => 'pinecone',
			'apikey' => '',
			'server' => ''
		]
	],
	'embeddings' => [
		'rewriteContent' => true,
		'rewritePrompt' => "Rewrite the content concisely in {LANGUAGE}, maintaining the same style and information. The revised text should be under 800 words, with paragraphs ranging from 160-280 words each. Omit non-textual elements and avoid unnecessary repetition. Conclude with a statement directing readers to find more information at {URL}. If you cannot meet these requirements, please leave a blank response. The content is below, between '== START ==' and '== END =='.\n\n== START ==\n{CONTENT}\n== END ==\n\n",
		'forceRecreate' => false,
		'syncPosts' => false,
		'syncPostsEnvId' => null,
		'syncPostTypes' => ['post', 'page', 'product'],
		'syncPostStatus' => ['publish'],
		'syncPostCategories' => [],
	],
	'public_api' => false,
	'debug_mode' => true,
	'server_debug_mode' => true,
	'logs_path' => null,
	'resolve_shortcodes' => false,
	'context_max_length' => 4096,
	'banned_words' => [],
	'banned_ips' => [],
	'languages' => MWAI_LANGUAGES,
	'clean_uninstall' => false,

	// ADMIN UI
	'intro_message' => true,
	'chatbot_select' => 'tabs'
] );

define( 'MWAI_ALL_LANGUAGES', [
	'aa' => 'Afar',
	'ab' => 'Abkhazian',
	'af' => 'Afrikaans',
	'ak' => 'Akan',
	'sq' => 'Albanian',
	'am' => 'Amharic',
	'ar' => 'Arabic',
	'an' => 'Aragonese',
	'hy' => 'Armenian',
	'as' => 'Assamese',
	'av' => 'Avaric',
	'ae' => 'Avestan',
	'ay' => 'Aymara',
	'az' => 'Azerbaijani',
	'ba' => 'Bashkir',
	'bm' => 'Bambara',
	'eu' => 'Basque',
	'be' => 'Belarusian',
	'bn' => 'Bengali',
	'bh' => 'Bihari',
	'bi' => 'Bislama',
	'bs' => 'Bosnian',
	'br' => 'Breton',
	'bg' => 'Bulgarian',
	'my' => 'Burmese',
	'ca' => 'Catalan; Valencian',
	'ch' => 'Chamorro',
	'ce' => 'Chechen',
	'zh' => 'Chinese',
	'cu' => 'Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic',
	'cv' => 'Chuvash',
	'kw' => 'Cornish',
	'co' => 'Corsican',
	'cr' => 'Cree',
	'cs' => 'Czech',
	'da' => 'Danish',
	'dv' => 'Divehi; Dhivehi; Maldivian',
	'nl' => 'Dutch; Flemish',
	'dz' => 'Dzongkha',
	'en' => 'English',
	'eo' => 'Esperanto',
	'et' => 'Estonian',
	'ee' => 'Ewe',
	'fo' => 'Faroese',
	'fj' => 'Fijjian',
	'fi' => 'Finnish',
	'fr' => 'French',
	'fy' => 'Western Frisian',
	'ff' => 'Fulah',
	'ka' => 'Georgian',
	'de' => 'German',
	'gd' => 'Gaelic; Scottish Gaelic',
	'ga' => 'Irish',
	'gl' => 'Galician',
	'gv' => 'Manx',
	'el' => 'Greek, Modern',
	'gn' => 'Guarani',
	'gu' => 'Gujarati',
	'ht' => 'Haitian; Haitian Creole',
	'ha' => 'Hausa',
	'he' => 'Hebrew',
	'hz' => 'Herero',
	'hi' => 'Hindi',
	'ho' => 'Hiri Motu',
	'hu' => 'Hungarian',
	'ig' => 'Igbo',
	'is' => 'Icelandic',
	'io' => 'Ido',
	'ii' => 'Sichuan Yi',
	'iu' => 'Inuktitut',
	'ie' => 'Interlingue',
	'ia' => 'Interlingua (International Auxiliary Language Association)',
	'id' => 'Indonesian',
	'ik' => 'Inupiaq',
	'it' => 'Italian',
	'jv' => 'Javanese',
	'ja' => 'Japanese',
	'kl' => 'Kalaallisut; Greenlandic',
	'kn' => 'Kannada',
	'ks' => 'Kashmiri',
	'kr' => 'Kanuri',
	'kk' => 'Kazakh',
	'km' => 'Central Khmer',
	'ki' => 'Kikuyu; Gikuyu',
	'rw' => 'Kinyarwanda',
	'ky' => 'Kirghiz; Kyrgyz',
	'kv' => 'Komi',
	'kg' => 'Kongo',
	'ko' => 'Korean',
	'kj' => 'Kuanyama; Kwanyama',
	'ku' => 'Kurdish',
	'lo' => 'Lao',
	'la' => 'Latin',
	'lv' => 'Latvian',
	'li' => 'Limburgan; Limburger; Limburgish',
	'ln' => 'Lingala',
	'lt' => 'Lithuanian',
	'lb' => 'Luxembourgish; Letzeburgesch',
	'lu' => 'Luba-Katanga',
	'lg' => 'Ganda',
	'mk' => 'Macedonian',
	'mh' => 'Marshallese',
	'ml' => 'Malayalam',
	'mi' => 'Maori',
	'mr' => 'Marathi',
	'ms' => 'Malay',
	'mg' => 'Malagasy',
	'mt' => 'Maltese',
	'mo' => 'Moldavian',
	'mn' => 'Mongolian',
	'na' => 'Nauru',
	'nv' => 'Navajo; Navaho',
	'nr' => 'Ndebele, South; South Ndebele',
	'nd' => 'Ndebele, North; North Ndebele',
	'ng' => 'Ndonga',
	'ne' => 'Nepali',
	'nn' => 'Norwegian Nynorsk; Nynorsk, Norwegian',
	'nb' => 'Bokmål, Norwegian, Norwegian Bokmål',
	'no' => 'Norwegian',
	'ny' => 'Chichewa; Chewa; Nyanja',
	'oc' => 'Occitan, Provençal',
	'oj' => 'Ojibwa',
	'or' => 'Oriya',
	'om' => 'Oromo',
	'os' => 'Ossetian; Ossetic',
	'pa' => 'Panjabi; Punjabi',
	'fa' => 'Persian',
	'pi' => 'Pali',
	'pl' => 'Polish',
	'pt' => 'Portuguese',
	'ps' => 'Pushto',
	'qu' => 'Quechua',
	'rm' => 'Romansh',
	'ro' => 'Romanian',
	'rn' => 'Rundi',
	'ru' => 'Russian',
	'sg' => 'Sango',
	'sa' => 'Sanskrit',
	'sr' => 'Serbian',
	'hr' => 'Croatian',
	'si' => 'Sinhala; Sinhalese',
	'sk' => 'Slovak',
	'sl' => 'Slovenian',
	'se' => 'Northern Sami',
	'sm' => 'Samoan',
	'sn' => 'Shona',
	'sd' => 'Sindhi',
	'so' => 'Somali',
	'st' => 'Sotho, Southern',
	'es' => 'Spanish; Castilian',
	'sc' => 'Sardinian',
	'ss' => 'Swati',
	'su' => 'Sundanese',
	'sw' => 'Swahili',
	'sv' => 'Swedish',
	'ty' => 'Tahitian',
	'ta' => 'Tamil',
	'tt' => 'Tatar',
	'te' => 'Telugu',
	'tg' => 'Tajik',
	'tl' => 'Tagalog',
	'th' => 'Thai',
	'bo' => 'Tibetan',
	'ti' => 'Tigrinya',
	'to' => 'Tonga (Tonga Islands)',
	'tn' => 'Tswana',
	'ts' => 'Tsonga',
	'tk' => 'Turkmen',
	'tr' => 'Turkish',
	'tw' => 'Twi',
	'ug' => 'Uighur; Uyghur',
	'uk' => 'Ukrainian',
	'ur' => 'Urdu',
	'uz' => 'Uzbek',
	've' => 'Venda',
	'vi' => 'Vietnamese',
	'vo' => 'Volapük',
	'cy' => 'Welsh',
	'wa' => 'Walloon',
	'wo' => 'Wolof',
	'xh' => 'Xhosa',
	'yi' => 'Yiddish',
	'yo' => 'Yoruba',
	'za' => 'Zhuang; Chuang',
	'zu' => 'Zulu',
] );