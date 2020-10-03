<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\ComponentDataBeanInterface;
use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractLink extends AbstractField
{

    public const TARGET_BLANK = '_blank';
    public const TARGET_SELF = '_self';
    public const TARGET_PARENT = '_parent';
    public const TARGET_TOP = '_top';

    public const OPTION_BUTTON_STYLE = 'button_style';


    public const ICON_ACTIVITY = 'activity';
    public const ICON_AIRPLAY = 'airplay';
    public const ICON_ALERT_CIRCLE = 'alert-circle';
    public const ICON_ALERT_OCTAGON = 'alert-octagon';
    public const ICON_ALERT_TRIANGLE = 'alert-triangle';
    public const ICON_ALIGN_CENTER = 'align-center';
    public const ICON_ALIGN_JUSTIFY = 'align-justify';
    public const ICON_ALIGN_LEFT = 'align-left';
    public const ICON_ALIGN_RIGHT = 'align-right';
    public const ICON_ANCHOR = 'anchor';
    public const ICON_APERTURE = 'aperture';
    public const ICON_ARCHIVE = 'archive';
    public const ICON_ARROW_DOWN_CIRCLE = 'arrow-down-circle';
    public const ICON_ARROW_DOWN_LEFT = 'arrow-down-left';
    public const ICON_ARROW_DOWN_RIGHT = 'arrow-down-right';
    public const ICON_ARROW_DOWN = 'arrow-down';
    public const ICON_ARROW_LEFT_CIRCLE = 'arrow-left-circle';
    public const ICON_ARROW_LEFT = 'arrow-left';
    public const ICON_ARROW_RIGHT_CIRCLE = 'arrow-right-circle';
    public const ICON_ARROW_RIGHT = 'arrow-right';
    public const ICON_ARROW_UP_CIRCLE = 'arrow-up-circle';
    public const ICON_ARROW_UP_LEFT = 'arrow-up-left';
    public const ICON_ARROW_UP_RIGHT = 'arrow-up-right';
    public const ICON_ARROW_UP = 'arrow-up';
    public const ICON_AT_SIGN = 'at-sign';
    public const ICON_AWARD = 'award';
    public const ICON_BAR_CHART_2 = 'bar-chart-2';
    public const ICON_BAR_CHART = 'bar-chart';
    public const ICON_BATTERY_CHARGING = 'battery-charging';
    public const ICON_BATTERY = 'battery';
    public const ICON_BELL_OFF = 'bell-off';
    public const ICON_BELL = 'bell';
    public const ICON_BLUETOOTH = 'bluetooth';
    public const ICON_BOLD = 'bold';
    public const ICON_BOOK_OPEN = 'book-open';
    public const ICON_BOOK = 'book';
    public const ICON_BOOKMARK = 'bookmark';
    public const ICON_BOX = 'box';
    public const ICON_BRIEFCASE = 'briefcase';
    public const ICON_CALENDAR = 'calendar';
    public const ICON_CAMERA_OFF = 'camera-off';
    public const ICON_CAMERA = 'camera';
    public const ICON_CAST = 'cast';
    public const ICON_CHECK_CIRCLE = 'check-circle';
    public const ICON_CHECK_SQUARE = 'check-square';
    public const ICON_CHECK = 'check';
    public const ICON_CHEVRON_DOWN = 'chevron-down';
    public const ICON_CHEVRON_LEFT = 'chevron-left';
    public const ICON_CHEVRON_RIGHT = 'chevron-right';
    public const ICON_CHEVRON_UP = 'chevron-up';
    public const ICON_CHEVRONS_DOWN = 'chevrons-down';
    public const ICON_CHEVRONS_LEFT = 'chevrons-left';
    public const ICON_CHEVRONS_RIGHT = 'chevrons-right';
    public const ICON_CHEVRONS_UP = 'chevrons-up';
    public const ICON_CHROME = 'chrome';
    public const ICON_CIRCLE = 'circle';
    public const ICON_CLIPBOARD = 'clipboard';
    public const ICON_CLOCK = 'clock';
    public const ICON_CLOUD_DRIZZLE = 'cloud-drizzle';
    public const ICON_CLOUD_LIGHTNING = 'cloud-lightning';
    public const ICON_CLOUD_OFF = 'cloud-off';
    public const ICON_CLOUD_RAIN = 'cloud-rain';
    public const ICON_CLOUD_SNOW = 'cloud-snow';
    public const ICON_CLOUD = 'cloud';
    public const ICON_CODE = 'code';
    public const ICON_CODEPEN = 'codepen';
    public const ICON_CODESANDBOX = 'codesandbox';
    public const ICON_COFFEE = 'coffee';
    public const ICON_COLUMNS = 'columns';
    public const ICON_COMMAND = 'command';
    public const ICON_COMPASS = 'compass';
    public const ICON_COPY = 'copy';
    public const ICON_CORNER_DOWN_LEFT = 'corner-down-left';
    public const ICON_CORNER_DOWN_RIGHT = 'corner-down-right';
    public const ICON_CORNER_LEFT_DOWN = 'corner-left-down';
    public const ICON_CORNER_LEFT_UP = 'corner-left-up';
    public const ICON_CORNER_RIGHT_DOWN = 'corner-right-down';
    public const ICON_CORNER_RIGHT_UP = 'corner-right-up';
    public const ICON_CORNER_UP_LEFT = 'corner-up-left';
    public const ICON_CORNER_UP_RIGHT = 'corner-up-right';
    public const ICON_CPU = 'cpu';
    public const ICON_CREDIT_CARD = 'credit-card';
    public const ICON_CROP = 'crop';
    public const ICON_CROSSHAIR = 'crosshair';
    public const ICON_DATABASE = 'database';
    public const ICON_DELETE = 'delete';
    public const ICON_DISC = 'disc';
    public const ICON_DOLLAR_SIGN = 'dollar-sign';
    public const ICON_DOWNLOAD_CLOUD = 'download-cloud';
    public const ICON_DOWNLOAD = 'download';
    public const ICON_DROPLET = 'droplet';
    public const ICON_EDIT_2 = 'edit-2';
    public const ICON_EDIT_3 = 'edit-3';
    public const ICON_EDIT = 'edit';
    public const ICON_EXTERNAL_LINK = 'external-link';
    public const ICON_EYE_OFF = 'eye-off';
    public const ICON_EYE = 'eye';
    public const ICON_FACEBOOK = 'facebook';
    public const ICON_FAST_FORWARD = 'fast-forward';
    public const ICON_FEATHER = 'feather';
    public const ICON_FIGMA = 'figma';
    public const ICON_FILE_MINUS = 'file-minus';
    public const ICON_FILE_PLUS = 'file-plus';
    public const ICON_FILE_TEXT = 'file-text';
    public const ICON_FILE = 'file';
    public const ICON_FILM = 'film';
    public const ICON_FILTER = 'filter';
    public const ICON_FLAG = 'flag';
    public const ICON_FOLDER_MINUS = 'folder-minus';
    public const ICON_FOLDER_PLUS = 'folder-plus';
    public const ICON_FOLDER = 'folder';
    public const ICON_FRAMER = 'framer';
    public const ICON_FROWN = 'frown';
    public const ICON_GIFT = 'gift';
    public const ICON_GIT_BRANCH = 'git-branch';
    public const ICON_GIT_COMMIT = 'git-commit';
    public const ICON_GIT_MERGE = 'git-merge';
    public const ICON_GIT_PULL_REQUEST = 'git-pull-request';
    public const ICON_GITHUB = 'github';
    public const ICON_GITLAB = 'gitlab';
    public const ICON_GLOBE = 'globe';
    public const ICON_GRID = 'grid';
    public const ICON_HARD_DRIVE = 'hard-drive';
    public const ICON_HASH = 'hash';
    public const ICON_HEADPHONES = 'headphones';
    public const ICON_HEART = 'heart';
    public const ICON_HELP_CIRCLE = 'help-circle';
    public const ICON_HEXAGON = 'hexagon';
    public const ICON_HOME = 'home';
    public const ICON_IMAGE = 'image';
    public const ICON_INBOX = 'inbox';
    public const ICON_INFO = 'info';
    public const ICON_INSTAGRAM = 'instagram';
    public const ICON_ITALIC = 'italic';
    public const ICON_KEY = 'key';
    public const ICON_LAYERS = 'layers';
    public const ICON_LAYOUT = 'layout';
    public const ICON_LIFE_BUOY = 'life-buoy';
    public const ICON_LINK_2 = 'link-2';
    public const ICON_LINK = 'link';
    public const ICON_LINKEDIN = 'linkedin';
    public const ICON_LIST = 'list';
    public const ICON_LOADER = 'loader';
    public const ICON_LOCK = 'lock';
    public const ICON_LOG_IN = 'log-in';
    public const ICON_LOG_OUT = 'log-out';
    public const ICON_MAIL = 'mail';
    public const ICON_MAP_PIN = 'map-pin';
    public const ICON_MAP = 'map';
    public const ICON_MAXIMIZE_2 = 'maximize-2';
    public const ICON_MAXIMIZE = 'maximize';
    public const ICON_MEH = 'meh';
    public const ICON_MENU = 'menu';
    public const ICON_MESSAGE_CIRCLE = 'message-circle';
    public const ICON_MESSAGE_SQUARE = 'message-square';
    public const ICON_MIC_OFF = 'mic-off';
    public const ICON_MIC = 'mic';
    public const ICON_MINIMIZE_2 = 'minimize-2';
    public const ICON_MINIMIZE = 'minimize';
    public const ICON_MINUS_CIRCLE = 'minus-circle';
    public const ICON_MINUS_SQUARE = 'minus-square';
    public const ICON_MINUS = 'minus';
    public const ICON_MONITOR = 'monitor';
    public const ICON_MOON = 'moon';
    public const ICON_MORE_HORIZONTAL = 'more-horizontal';
    public const ICON_MORE_VERTICAL = 'more-vertical';
    public const ICON_MOUSE_POINTER = 'mouse-pointer';
    public const ICON_MOVE = 'move';
    public const ICON_MUSIC = 'music';
    public const ICON_NAVIGATION_2 = 'navigation-2';
    public const ICON_NAVIGATION = 'navigation';
    public const ICON_OCTAGON = 'octagon';
    public const ICON_PACKAGE = 'package';
    public const ICON_PAPERCLIP = 'paperclip';
    public const ICON_PAUSE_CIRCLE = 'pause-circle';
    public const ICON_PAUSE = 'pause';
    public const ICON_PEN_TOOL = 'pen-tool';
    public const ICON_PERCENT = 'percent';
    public const ICON_PHONE_CALL = 'phone-call';
    public const ICON_PHONE_FORWARDED = 'phone-forwarded';
    public const ICON_PHONE_INCOMING = 'phone-incoming';
    public const ICON_PHONE_MISSED = 'phone-missed';
    public const ICON_PHONE_OFF = 'phone-off';
    public const ICON_PHONE_OUTGOING = 'phone-outgoing';
    public const ICON_PHONE = 'phone';
    public const ICON_PIE_CHART = 'pie-chart';
    public const ICON_PLAY_CIRCLE = 'play-circle';
    public const ICON_PLAY = 'play';
    public const ICON_PLUS_CIRCLE = 'plus-circle';
    public const ICON_PLUS_SQUARE = 'plus-square';
    public const ICON_PLUS = 'plus';
    public const ICON_POCKET = 'pocket';
    public const ICON_POWER = 'power';
    public const ICON_PRINTER = 'printer';
    public const ICON_RADIO = 'radio';
    public const ICON_REFRESH_CCW = 'refresh-ccw';
    public const ICON_REFRESH_CW = 'refresh-cw';
    public const ICON_REPEAT = 'repeat';
    public const ICON_REWIND = 'rewind';
    public const ICON_ROTATE_CCW = 'rotate-ccw';
    public const ICON_ROTATE_CW = 'rotate-cw';
    public const ICON_RSS = 'rss';
    public const ICON_SAVE = 'save';
    public const ICON_SCISSORS = 'scissors';
    public const ICON_SEARCH = 'search';
    public const ICON_SEND = 'send';
    public const ICON_SERVER = 'server';
    public const ICON_SETTINGS = 'settings';
    public const ICON_SHARE_2 = 'share-2';
    public const ICON_SHARE = 'share';
    public const ICON_SHIELD_OFF = 'shield-off';
    public const ICON_SHIELD = 'shield';
    public const ICON_SHOPPING_BAG = 'shopping-bag';
    public const ICON_SHOPPING_CART = 'shopping-cart';
    public const ICON_SHUFFLE = 'shuffle';
    public const ICON_SIDEBAR = 'sidebar';
    public const ICON_SKIP_BACK = 'skip-back';
    public const ICON_SKIP_FORWARD = 'skip-forward';
    public const ICON_SLACK = 'slack';
    public const ICON_SLASH = 'slash';
    public const ICON_SLIDERS = 'sliders';
    public const ICON_SMARTPHONE = 'smartphone';
    public const ICON_SMILE = 'smile';
    public const ICON_SPEAKER = 'speaker';
    public const ICON_SQUARE = 'square';
    public const ICON_STAR = 'star';
    public const ICON_STOP_CIRCLE = 'stop-circle';
    public const ICON_SUN = 'sun';
    public const ICON_SUNRISE = 'sunrise';
    public const ICON_SUNSET = 'sunset';
    public const ICON_TABLET = 'tablet';
    public const ICON_TAG = 'tag';
    public const ICON_TARGET = 'target';
    public const ICON_TERMINAL = 'terminal';
    public const ICON_THERMOMETER = 'thermometer';
    public const ICON_THUMBS_DOWN = 'thumbs-down';
    public const ICON_THUMBS_UP = 'thumbs-up';
    public const ICON_TOGGLE_LEFT = 'toggle-left';
    public const ICON_TOGGLE_RIGHT = 'toggle-right';
    public const ICON_TOOL = 'tool';
    public const ICON_TRASH_2 = 'trash-2';
    public const ICON_TRASH = 'trash';
    public const ICON_TRELLO = 'trello';
    public const ICON_TRENDING_DOWN = 'trending-down';
    public const ICON_TRENDING_UP = 'trending-up';
    public const ICON_TRIANGLE = 'triangle';
    public const ICON_TRUCK = 'truck';
    public const ICON_TV = 'tv';
    public const ICON_TWITCH = 'twitch';
    public const ICON_TWITTER = 'twitter';
    public const ICON_TYPE = 'type';
    public const ICON_UMBRELLA = 'umbrella';
    public const ICON_UNDERLINE = 'underline';
    public const ICON_UNLOCK = 'unlock';
    public const ICON_UPLOAD_CLOUD = 'upload-cloud';
    public const ICON_UPLOAD = 'upload';
    public const ICON_USER_CHECK = 'user-check';
    public const ICON_USER_MINUS = 'user-minus';
    public const ICON_USER_PLUS = 'user-plus';
    public const ICON_USER_X = 'user-x';
    public const ICON_USER = 'user';
    public const ICON_USERS = 'users';
    public const ICON_VIDEO_OFF = 'video-off';
    public const ICON_VIDEO = 'video';
    public const ICON_VOICEMAIL = 'voicemail';
    public const ICON_VOLUME_1 = 'volume-1';
    public const ICON_VOLUME_2 = 'volume-2';
    public const ICON_VOLUME_X = 'volume-x';
    public const ICON_VOLUME = 'volume';
    public const ICON_WATCH = 'watch';
    public const ICON_WIFI_OFF = 'wifi-off';
    public const ICON_WIFI = 'wifi';
    public const ICON_WIND = 'wind';
    public const ICON_X_CIRCLE = 'x-circle';
    public const ICON_X_OCTAGON = 'x-octagon';
    public const ICON_X_SQUARE = 'x-square';
    public const ICON_X = 'x';
    public const ICON_YOUTUBE = 'youtube';
    public const ICON_ZAP_OFF = 'zap-off';
    public const ICON_ZAP = 'zap';
    public const ICON_ZOOM_IN = 'zoom-in';
    public const ICON_ZOOM_OUT = 'zoom-out';

    /**
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $icon;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/link';
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTarget(): bool
    {
        return $this->target !== null;
    }

    /**
     * @param ComponentDataBeanInterface|null $bean
     * @return string
     */
    public function getAction(?ComponentDataBeanInterface $bean = null): string
    {
        if (null === $bean) {
            return $this->action;
        } else {
            return $this->replacePlaceholders($this->action, $bean);
        }
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return $this->action !== null;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     *
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasStyle(): bool
    {
        return $this->style !== null;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }


    /**
     * @return string
     */
    public function getClass(): string
    {
        $result = "mr-1 ";
        if ($this->hasOption(self::OPTION_BUTTON_STYLE)) {
            $result = ' btn';
            if ($this->hasStyle()) {
                $result .= ' btn-' . $this->getStyle();
            }
        }
        return $result;
    }
}
