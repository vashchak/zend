<?php

class Application_Model_DbTable_Movies extends Zend_Db_Table_Abstract
{
	// ��� �������, � ������� ����� ��������
	protected $_name = 'movies';

	// ����� ��� ��������� ������ �� id
	public function getMovie($id)
	{
		// �������� id ��� ��������
		$id = (int)$id;

		// ���������� ����� fetchRow ��� ��������� ������ �� ����.
		// � ������� ��������� ������� ������� (��������� ��� ��� where)
		$row = $this->fetchRow('id = ' . $id);

		// ���� ��������� ������, ���������� ����������
		if(!$row) {
			throw new Exception("��� ������ � id - $id");
		}
		// ���������� ���������, ����������� � ������
		return $row->toArray();
	}

	// ����� ��� ���������� ����� ������
	public function addMovie($director, $title)
	{
		// ��������� ������ ����������� ��������
		$data = array(
				'director' => $director,
				'title' => $title,
		);

		// ���������� ����� insert ��� ������� ������ � ����
		$this->insert($data);
	}

	// ����� ��� ���������� ������
	public  function updateMovie($id, $director, $title)
	{
		// ��������� ������ ��������
		$data = array(
				'director' => $director,
				'title' => $title,
		);

		// ���������� ����� update ��� ���������� ������
		// � ������� ��������� ������� ���������� (��������� ��� ��� where)
		$this->update($data, 'id = ' . (int)$id);
	}

	// ����� ��� �������� ������
	public function deleteMovie($id)
	{
		// � ������� ��������� ������� �������� (��������� ��� ��� where)
		$this->delete('id = ' . (int)$id);
	}
}
