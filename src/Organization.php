<?php

declare(strict_types=1);

namespace Overfair\StatGovSDK;

use DateTime;
use Kuvardin\DataFilter\DataFilter;

/**
 * Class Organization
 * @package Overfair\StatGovSDK
 */
class Organization
{
    /**
     * @var int ID
     */
    public int $id;

    /**
     * @var string БИН / ИИН
     */
    public string $biin;

    /**
     * @var string|null Наименование
     */
    public ?string $name;

    /**
     * @var DateTime|null Дата регистрации
     */
    public ?DateTime $register_date;

    /**
     * @var string Основной код ОКЭД
     */
    public string $oked_code;

    /**
     * @var string|null Наименование вида экономической деятельности
     */
    public ?string $oked_name;

    /**
     * @var string|null Вторичный код ОКЭД
     */
    public ?string $second_okeds;

    /**
     * @var string Код КРП (с учетом филиалов)
     */
    public string $krp_code;

    /**
     * @var string|null Наименование КРП
     */
    public ?string $krp_name;

    /**
     * @var string|null Код КРП (без учета филиалов)
     */
    public ?string $krp_bf_code;

    /**
     * @var string|null Наименование КРП
     */
    public ?string $krp_bf_name;

    /**
     * @var string КАТО
     */
    public string $kato_code;

    /**
     * @var int ID КАТО
     */
    public int $kato_id;

    /**
     * @var string Юридический адрес / Местонахождение ИП
     */
    public string $kato_address;

    /**
     * @var string Фамилия, имя, отчество руководителя
     */
    public string $director_full_name;

    /**
     * @var bool Флаг 'Индивидуальный предпринематель'
     */
    public bool $is_individual;

    /**
     * Organization constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->biin = $data['bin'];
        $this->name = DataFilter::requireNotEmptyString($data['name'], true);
        $this->register_date = isset($data['registerDate']) ? new DateTime($data['registerDate']) : null;
        $this->oked_code = DataFilter::requireNotEmptyString($data['okedCode']);
        $this->oked_name = DataFilter::requireNotEmptyString($data['okedName'], true);
        $this->second_okeds = isset($data['secondOkeds'])
            ? DataFilter::requireNotEmptyString($data['secondOkeds'])
            : null;
        $this->krp_code = DataFilter::requireNotEmptyString($data['krpCode']);
        $this->krp_name = DataFilter::requireNotEmptyString($data['krpName'], true);
        $this->krp_bf_code = isset($data['krpBfCode']) ? DataFilter::requireNotEmptyString($data['krpBfCode']) : null;
        $this->krp_bf_name = isset($data['krpBfName'])
            ? DataFilter::requireNotEmptyString($data['krpBfName'], true)
            : null;
        $this->kato_code = DataFilter::requireNotEmptyString($data['katoCode']);
        $this->kato_id = $data['katoId'];
        $this->kato_address = DataFilter::requireNotEmptyString($data['katoAddress'], true);
        $this->director_full_name = DataFilter::requireNotEmptyString($data['fio']);
        $this->is_individual = $data['ip'];
        DataFilter::searchUnknownFields($data, ['id', 'bin', 'name', 'registerDate', 'okedCode', 'okedName',
            'secondOkeds', 'krpCode', 'krpName', 'krpBfCode', 'krpBfName', 'katoId', 'katoCode', 'katoAddress', 'fio', 'ip']);
    }
}