# ButtonsColor
﻿Instalação:

     1. Copie a pasta “Hibrido” a app/code
     2. Execute o comando php bin/magento setup:upgrade

Instruções de uso:

Para alterar a cor dos botões, execute o seguinte comando:

php bin/magento hibrido_themesettings:buttonscolor "33ff58" "2"

Onde o primeiro parâmetro é o código hexadecimal da cor desejada e o segundo o id da loja que você deseja afetar.

Para alterar a cor no escopo “default config”, basta colocar no segundo parâmetro “default” da seguinte forma:

php bin/magento hibrido_themesettings:buttonscolor "33ff58" "default"

Como um valor agregado na configuração do Magento, especificamente na seção Stores→Configuration→Hibrido→Theme Options→General Options→Buttons Color, também será possível alterar a cor dos botões.
