<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Export;
use App\Filter\Export\ExportFilterProvider;
use App\Normalizer\Export\ExportFilterNormalizer;
use App\Normalizer\Export\ExportNormalizer;
use App\Template\CollectionProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExportController extends AbstractController
{
    private const EXPORT_COLLECTION = 'exports';

    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly CollectionProviderInterface $collectionProvider)
    {
    }

    #[Route('/export', name: 'export', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $filter = ExportFilterProvider::get($request);
        $exportFilterNormalizer = new ExportFilterNormalizer();
        $normalizeFilterData = $exportFilterNormalizer->normalize($filter);
        $exports = $this->entityManager->getRepository(Export::class)->findByFilter($normalizeFilterData);
        $templateData = array_merge($normalizeFilterData ,$this->collectionProvider->getCollection($exports, new ExportNormalizer(), self::EXPORT_COLLECTION));
        return $this->render('export/index.html.twig', $templateData);
    }

}
