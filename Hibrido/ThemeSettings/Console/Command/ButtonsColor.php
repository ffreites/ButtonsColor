<?php

namespace Hibrido\ThemeSettings\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ButtonsColor extends Command
{

    const COLOR_ARGUMENT = "color";
    const STORE_ARGUMENT = "storeId";

    public function __construct(
        \Hibrido\ThemeSettings\Helper\ConfigHelper $configHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Cache\Manager $cacheManager
    ) {
        $this->configHelper = $configHelper;
        $this->storeManager = $storeManager;
        $this->cacheManager = $cacheManager;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        try {
            $color = $input->getArgument(self::COLOR_ARGUMENT);
            $store = $input->getArgument(self::STORE_ARGUMENT);

            if ($this->storeManager->getStore($store) || $store == 'default') {
                if (ctype_xdigit($color) && strlen($color) == 6) {

                    $this->configHelper->setConfig('buttons_color', $color, $store);

                    $this->cacheManager->clean($this->cacheManager->getAvailableTypes());
                    $output->writeln("The buttons color for storeId " . $store . " was change to " . $color);
                } else {
                    $output->writeln("Please enter a valid hexadecimal color without '#' char");
                }
            }
        } catch (\Throwable $th) {
            $output->writeln($th->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("hibrido_themesettings:buttonscolor");
        $this->setDescription("Change buttons color per store view");
        $this->setDefinition([
            new InputArgument(self::COLOR_ARGUMENT, InputArgument::REQUIRED, "color"),
            new InputArgument(self::STORE_ARGUMENT, InputArgument::REQUIRED, "store"),
        ]);
        parent::configure();
    }
}
