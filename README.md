# SmartBOT

This repo is a simple working [DiscordPHP] bot.

Foi criado um container principal(Application) que inicializa o *DiscordCommandClient* e o *Logger*.
Há uma classe(Commands) responsável por acessar o container e o *DiscordCommandClient* e registrar os comandos existentes na varíavel  *$commands*.

Para iniciar o bot basta rodar **php index.php**.

[DiscordPHP]: https://github.com/teamreflex/DiscordPHP
